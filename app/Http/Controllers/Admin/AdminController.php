<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;

class AdminController extends Controller
{
    public function index(){
        return view('auth.admin.home');
    }

    public function editProfile(){
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::find($id);

        return view('auth.admin.edit_profile', ['admin' => $admin]);
    }
}
