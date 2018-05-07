<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enent extends Model
{
    //
    protected $guarded=[];

    public function store(){
        return $this->belongsTo('store_infos','id');
    }
}
