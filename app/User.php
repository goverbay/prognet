<?php

namespace App;

use App\user_notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product(){
        return $this->belongsToMany('App\Produk', 'product_reviews', 'user_id', 'product_id')->withPivot('id');
    }

    public function cart(){
        return $this->hasMany('App\cart', 'user_id', 'id');
    }

    public function product_cart(){
        return $this->belongsToMany('App\Produk', 'carts', 'user_id', 'product_id')->withPivot('id');
    }

    public function notifications(){
            return $this->morphMany(user_notification::class, 'notifiable')->orderBy('created_at','desc');
    }
}
