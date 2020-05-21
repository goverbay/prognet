<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
    protected $table = 'response';

    public function admin(){
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }
}
