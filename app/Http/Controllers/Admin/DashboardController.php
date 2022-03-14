<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * get dashboard
 * Class DashboardController
 * @package App\Http\Controllers\Dashboard
 */
class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard.index');
    }
}
