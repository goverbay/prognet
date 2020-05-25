<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Model;

class admin_notification extends DatabaseNotification
{
    protected $table='admin_notifications';
}
