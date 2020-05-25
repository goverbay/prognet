<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class NotifyUser extends Controller
{
   public function read(){
       $user = User::find(auth()->user()->id);
       $user->unReadNotifications->markAsRead();
       return redirect('/notif');
   }
}
