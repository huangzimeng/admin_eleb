<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected  $fillable = [
        'name','password','email'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
