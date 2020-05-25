<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Model;

class user_notification extends DatabaseNotification
{
    protected $table = 'user_notifications';
}
