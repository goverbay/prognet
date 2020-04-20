<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product_category_detail extends Model
{
    public function product(){
        return $this->belongsTo('App\Produk','product_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Kategori','category_id','id');
    }
}
