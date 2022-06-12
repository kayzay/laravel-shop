<?php

namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestsEditAdminUser;
use App\Http\Requests\Admin\RequestsAdminUser;
use App\Models\Admin\AdminStatus;
use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminUser as ModelAdminUser;
use App\Repository\Admin\RepositoryAdminStatus;
use App\Repository\Admin\RepositoryAdminUserGroup;
use App\Repository\Admin\RepositoryUserAdmin;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(AdminUser::class, AdminUser::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $repository = RepositoryUserAdmin::getInstance();
        $data = $repository->adminTableList();

        return view('admin.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $group =  RepositoryAdminUserGroup::getInstance()->selectGroup(0);
        $status = RepositoryAdminStatus::getInstance()->selectStatus(0);

        $data = [
            'groupList' => $group,
            'statusList' => $status
        ];
        return view('admin.admin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsAdminUser $request)
    {
        ModelAdminUser::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'status' => $request->get('status'),
            'group_id' => $request->get('group'),
            'password' => Hash::make($request->get('password')),
        ]);


            return  redirect()
                ->route('admin.users.index')
                ->with('status', getTextAdmin('mess_add_adm', 'custom'));
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
        $repository = RepositoryUserAdmin::getInstance();
        $data = $repository->editAdminUser($id);
        if (is_bool($data)) {
            return redirect()
                ->route('admin.users.index')
                ->withErrors(['msg' => __('admin_user.dont_found')]);
        }

        $group =  RepositoryAdminUserGroup::getInstance()->selectGroup($data['group_id']);
        $status = RepositoryAdminStatus::getInstance()->selectStatus($data['status']);

        return view('admin.admin.edit', [
            'groupList' => $group,
            'statusList' => $status,
            'info' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestsEditAdminUser $request, $id)
    {
        $AdmUser = AdminUser::find($id);
        $AdmUser->name = $request->get('name');
        $AdmUser->email = $request->get('email');
        $pass = $request->get('password');
        if (!empty($pass)) {
            $AdmUser->password = Hash::make($pass);
        }

        $AdmUser->group_id = $request->get('group');
        $status = $request->get('status');

        if (adminAuth()->id() == $id) {
            if ($status != AdminStatus::ADMIN_STATUS_ACTIVE) {
                return redirect()
                    ->route('admin.users.index')
                    ->with('status', getTextAdmin('mess_mistake_del', 'custom'));
            }
        }

        $AdmUser->status = $status;

        if($AdmUser->isDirty()) {
            $AdmUser->update();
        }

        return redirect()
            ->route('admin.users.index')
            ->with('status', getTextAdmin('mess_edit_adm', 'custom'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (adminAuth()->id() == $id) {

            return redirect()
                ->route('admin.users.index')
                ->with('status', getTextAdmin('mess_mistake_del_adm', 'custom'));
        }
        $AdmUser = AdminUser::find($id);
        $AdmUser->update(['status' => AdminStatus::ADMIN_STATUS_INACTIVE]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', getTextAdmin('mess_del_adm', 'custom'));
    }
}
