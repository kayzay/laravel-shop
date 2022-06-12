<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\RequestGroup;
use App\Models\Admin\AdminRule;
use App\Models\Admin\AdminUserGroup;
use App\Repository\Admin\RepositoryAdminGroupPolicy;
use App\Repository\Admin\RepositoryAdminRules;
use App\Repository\Admin\RepositoryAdminUserGroup;

class AdminUserGroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AdminUserGroup::class, AdminUserGroup::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $repository = RepositoryAdminUserGroup::getInstance();
        $data = $repository->groupTableList();

        return view('admin.admin.group.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repository = RepositoryAdminGroupPolicy::getInstance();
        $data = [
            'policyList' => $repository->tablePolicyList()
        ];

        return view('admin.admin.group.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestGroup $request)
    {
        $group = new AdminUserGroup();
        $group->name = $request->get('name');
        $group->save();
        $adminId = adminAuth()->id();

        if ($group->id) {
            $policyRules = RepositoryAdminGroupPolicy::getInstance();
            $policyRules = $policyRules->getFormatPolicy($request->get('rule'), $group->id, adminAuth()->id());

            array_map(function ($item) {
                AdminRule::create($item);
            }, $policyRules);
        }

        return redirect()
            ->route('admin.group.index')
            ->with('status', getTextAdmin('mess_add_adm_gr', 'custom'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repositoryGroup = RepositoryAdminUserGroup::getInstance();
        $repositoryPolicy = RepositoryAdminGroupPolicy::getInstance();
        $data = [
            'policyList' => $repositoryPolicy->tablePolicyList(),
            'group' =>  $repositoryGroup->getRules($id),
            'policy' => function($item, $id, $r) {
                if (isset($item[$id][$r])) {
                    return ($item[$id][$r]);
                }
                return false;
            }
        ];

        return view('admin.admin.group.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestGroup $request, $id)
    {
        $group = new AdminUserGroup();
        $group->name = $request->get('name');
        if ($group->isDirty('name')) {
            $group->update();
        }


        $adminId = adminAuth()->id();
        $repositoryGroup = RepositoryAdminRules::getInstance();
        $adminRule = $repositoryGroup->getRules($id);

        $policyRules = RepositoryAdminGroupPolicy::getInstance();
        $policyRules = $policyRules->getFormatPolicy($request->get('rule'), $id, $adminId);


        if ($adminRule->isEmpty()) {
            array_map(function ($item) {
                AdminRule::create($item);
            }, $policyRules);
        } else {
            foreach ($adminRule as $item) {
                if (isset($policyRules[$item->admin_policy_id])) {
                    $item->fill($policyRules[$item->admin_policy_id]);
                } else {
                    $item->rules = 0;
                }
                if ($item->isDirty()) {
                    $item->update();
                }
                unset($policyRules[$item->admin_policy_id]);
            }

            if (!empty($policyRules)) {
                array_map(function ($item) {
                    AdminRule::create($item);
                }, $policyRules);
            }
        }

        return redirect()
            ->route('admin.group.index')
            ->with('status', getTextAdmin('mess_edit_adm_gr', 'custom'));
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
