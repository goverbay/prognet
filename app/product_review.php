<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class product_review extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function product(){
        return $this->belongsTo('App\Produk', 'product_id', 'id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function response(){
        return $this->hasMany('App\response', 'review_id', 'id');
    }
}
