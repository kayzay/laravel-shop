<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop\Price\Price;
use App\Models\UserGroup;
use Illuminate\Routing\Route;

class DashboardController extends Controller
{

    public function index()
    {
        $data  = [];
       return view('admin.dashboard', $data);
    }
}
