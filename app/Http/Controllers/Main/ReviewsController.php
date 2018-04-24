<?php

namespace App\Http\Controllers\Main;

use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    //审核店铺信息
    public function review(StoreInfo $review){
        $id = $review->id;
        DB::table('store_infos')->where('id',$id)->update(['status'=>1]);
        session()->flash('success','审核成功!');
        return redirect()->route('home.index');
    }
}
