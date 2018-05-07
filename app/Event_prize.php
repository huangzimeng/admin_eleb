<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    //抽奖活动奖品表
    protected $guarded=[];

    public function enent(){
        return $this->belongsTo('App\enent','events_id');
    }

    public function member(){
        return $this->belongsTo('App\StoreInfo','member_id');
    }
}
