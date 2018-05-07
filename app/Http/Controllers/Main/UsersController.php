<?php

namespace App\Http\Controllers\Main;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

//会员管理
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //会员列表
    public function index(){
//        $users = DB::table('users')->get();
        $users = User::all();
        return view('users.index',compact('users'));
    }
    //禁用会员 or 恢复会员
    public function down(User $user){
        if ($user->status){//正常
            DB::table('users')->where('id',$user->id)->update(['status'=>0]);
        }else{//被禁用
            DB::table('users')->where('id',$user->id)->update(['status'=>1]);
        }
        session()->flash('success','操作成功!');
        return redirect()->route('users.index');
    }
}
