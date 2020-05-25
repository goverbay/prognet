<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;


class user_notification extends DatabaseNotification
{
    protected $table = 'user_notifications';
}
