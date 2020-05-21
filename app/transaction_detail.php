<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    public function transcation(){
        return $this->belongsTo('App\transaction', 'transaction_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\Produk', 'product_id', 'id');
    }
}
