<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
   public function baca(){
       $admin = Admin::find(1);
        $admin->unReadNotifications->markAsRead();
        return redirect('/admin/notif');
   }
}
