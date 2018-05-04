<?php

namespace App\Http\Controllers\Main;

use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //审核店铺信息
    public function review(StoreInfo $review){
        $id = $review->id;
        DB::table('store_infos')->where('id',$id)->update(['status'=>1]);
        session()->flash('success','审核成功!');
        return redirect()->route('home.index');
    }
}
