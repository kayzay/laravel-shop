<?php

namespace App\Http\Controllers\Admin\Shop;


use App\Helpers\Categories\PreparationAddCategory;
use App\Helpers\Categories\PreparationEditCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategotyRequest;
use App\Models\Shop\Category\Category;
use App\Models\Shop\Category\CategoryDescription;
use App\Models\Shop\Category\CategoryStatus;
use App\Repository\Category\RepositoryCategory;
use App\Repository\Category\RepositoryCategoryStatus;
use App\Repository\RepositoryLanguage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, Category::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data  = RepositoryCategory::getInstance()->listCategoryTable();

        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $locale = RepositoryLanguage::getInstance()->activeLanguageList();
        $repositoryCategory = RepositoryCategory::getInstance();

        $data  = [
            'defaultPage' => RepositoryLanguage::getDefaultLanguageAbr(),
            'languages' => $locale,
            'statusList' =>RepositoryCategoryStatus::staticListStatus(0),
            'categoryList' =>  $repositoryCategory->selectCategory(0),
            'logo' => $repositoryCategory::getDefaultLogo()
        ];

        return view('admin.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategotyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategotyRequest $request)
    {
        $preparation = PreparationAddCategory::getInstance();
        $main = $preparation
                    ->addCategory($request->all())
                    ->saveLogo($request->file('main.img'), RepositoryCategory::getDefaultLogo())
                    ->getData('main');


        $newCategory = new Category($main);
        $newCategory->save();

        if($newCategory->id) {
           $descriptions = $preparation
                                ->addCategoryDescription($newCategory->id)
                                ->getData('descriptions');

            foreach($descriptions as $item) {
                CategoryDescription::create($item);
            }
        }
        return redirect()
            ->route('category.index')
            ->with('status', getTextAdmin('mess_add_cat', 'custom'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $repositoryCategory = RepositoryCategory::getInstance();
        $category = $repositoryCategory->editCategory($id);

        if (is_bool($category)) {
            return redirect()
                ->route('category.index')
                ->withErrors(['msg' => getTextAdmin('dont_found_cat', 'custom')]);
        }

        $locale = RepositoryLanguage::getInstance()->activeLanguageList();
        $langID = RepositoryLanguage::getDefaultLanguageID();
        $data = [
            'defaultPage' => RepositoryLanguage::getDefaultLanguageAbr(),
            'languages' => $locale,
            'statusList' => RepositoryCategoryStatus::staticListStatus($category['status']),
            'categoryList' => $repositoryCategory->selectCategory($category['parent_id']),
            'logo' => $category['img'],
            'info' => $category,
            'h1Mame' => $category['descriptions'][$langID]['name']
        ];

        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategotyRequest $request, $id)
    {

        $preparation = PreparationEditCategory::getInstance();
        $data = $preparation
            ->editCategory($request->all())
            ->saveLogo($request->file('main.img'))
            ->editDescription($id)
            ->getData();

        $category = Category::find($id);
        $category->fill($data['main']);
        if ($category->isDirty()) {
            $category->update();
        }

        $categoryDescriptions = CategoryDescription::where('category_id', $id)->get();

        foreach ($categoryDescriptions as $item) {
            $langID = $item->language_id;
            $description = $data['descriptions'][$langID];

            $item->fill($description);

            if ($item->isDirty()) {
                $item->update();
            }
        }

        return redirect()
            ->route('category.index')
            ->with('status', getTextAdmin('mess_edit_cat', 'custom'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->update(['status' => CategoryStatus::STATUS_INACTIVE]);

        return redirect()
                ->route('category.index')
                ->with('status', getTextAdmin('mess_delete_cat', 'custom'));
    }
}
