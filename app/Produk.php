<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];

    public function product_category_detail(){
        return $this->hasMany('App\product_category_detail','product_id','id');
    }

    public function product_image(){
        return $this->hasMany('App\product_image','product_id','id');
    }

    public function category(){
        return $this->belongsToMany('App\Kategori','product_category_details', 'product_id', 'category_id')->withPivot('id');
    }

    public function discount(){
        return $this->hasMany('App\discount', 'id_product', 'id');
    }
}
