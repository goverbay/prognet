<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'product_categories';
    protected $dates = ['deleted_at'];

    public function product_category_detail(){
        return $this->hasMany('App\product_category_detail','category_id','id');
    }

    public function product(){
        return $this->belongsToMany('App\Produk','product_category_details','product_id', 'category_id')->withPivot('id');
    }
}
