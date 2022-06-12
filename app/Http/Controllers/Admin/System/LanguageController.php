<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageAdmin;
use App\Models\Language;
use App\Repository\RepositoryLanguage;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Language::class, Language::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $repository = RepositoryLanguage::getInstance();

        return view('admin.system.language.index', $repository->tableList());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.system.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LanguageAdmin $request)
    {
       Language::create([
           'name' => $request->get('name'),
           'abr' => $request->get('abr'),
           'local' => $request->get('local'),
           'available' => $request->get('available') ?? 0
        ]);

        return  redirect()
            ->route('system.language.index')
            ->with('status', getTextAdmin('language_mess_add'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $repository = RepositoryLanguage::getInstance();

        $data = $repository->editLanguage($id);

        return view('admin.system.language.edit', ['info' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageAdmin $request, $id)
    {
        if ($id == RepositoryLanguage::getDefaultLanguageId()) {
            return redirect()
                ->route('system.language.index')
                ->with('status', getTextAdmin('language_def', 'custom'));
        }

        $lang = Language::find($id);
        $lang->name = $request->get('name');
        $lang->abr = $request->get('abr');
        $lang->local = $request->get('local');
        $lang->available = $request->get('available') ?? 0;

        if ($lang->isDirty()) {
            $lang->update();
        }

        return redirect()
            ->route('system.language.index')
            ->with('status', getTextAdmin('language_mess_edit', 'custom'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
