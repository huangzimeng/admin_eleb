<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class ShopUser extends Authenticatable
{
    //
    protected $fillable = [
        'name','email','password','status','shop_store_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //模型关联
    public function storeinfo()
    {
        return $this->belongsTo('App\StoreInfo','shop_store_id');
    }
}
