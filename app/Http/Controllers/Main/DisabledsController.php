<?php

namespace App\Http\Controllers\Main;

use App\ShopUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DisabledsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //禁用账号控制器
    public function disabled(ShopUser $disabled){
        $id = $disabled->id;
        DB::table('shop_users')->where('id',$id)->update(['status'=>0]);
        session()->flash('success','已禁用!');
        return redirect()->route('home.index');
    }
    //启用账号控制器
    public function enable(ShopUser $enable){
        $id = $enable->id;
        DB::table('shop_users')->where('id',$id)->update(['status'=>1]);
        session()->flash('success','已启用!');
        return redirect()->route('home.index');
    }
}
