<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public function product(){
        return $this->belongsTo('App\Produk', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
