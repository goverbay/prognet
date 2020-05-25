<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class admin_notification extends DatabaseNotification
{
    protected $table = 'admin_notifications';
}
