<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginsController extends Controller
{
    //表单页
    public function create(){
        return view('Login.create');
    }
    //验证
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'captcha'=>'required|captcha',
            ],
            [
                'name.required'=>'请填写名称!',
                'password.required'=>'请填写密码!',
                'captcha.required'=>'请填写验证码!',
                'captcha.captcha'=>'验证码错误!'
            ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('rememberMe'))){
            //登录成功
            session()->flash('success','登录成功!');
            return redirect()->route('home.index');
        }else{
            //登录失败
            session()->flash('danger','登录失败!用户名或密码错误!');
            return redirect()->route('login');
        }
    }
    //注销
    public function destroy(){
        Auth::logout();
        session()->flash('success','注销成功!');
        return redirect()->route('login');
    }
}
