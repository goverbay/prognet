<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_review extends Model
{
    public function product(){
        return $this->belongsTo('App\Produk');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
