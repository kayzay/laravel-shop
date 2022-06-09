<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LogInRequest;
use App\Models\Admin\AdminStatus;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;


class AdminLogInController extends Controller
{


   public function __construct()
   {
        $this->middleware('guest:admin', ['except' => ['logout']]);
   }

   public function login()
   {
       return view('admin.auth.login');
   }


   public function signIn(LogInRequest $request)
   {
        $credential = $request->only('email', 'password');
        $credential['status'] = AdminStatus::ADMIN_STATUS_ACTIVE;

        if(adminAuth()->attempt($credential)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput();
   }

   public function logout(Request $request)
   {
       adminAuth()->logout();
       $request->session()->flush();
       $request->session()->regenerate();

       return redirect()->route('login');
   }
}
