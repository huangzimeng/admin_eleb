<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreInfo extends Model
{
    //
    protected $fillable =[
        'shop_name','shop_img','service_code','foods_code','high_or_low','h_l_percent','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','send_cost','estimate_time','notice','discount','shop_user_id','address','category_id'
    ];
}
