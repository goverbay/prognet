<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discount extends Model
{
    public function product(){
        return $this->belongsTo('App\Produk','id_product', 'id');
    }
}
