<?php

namespace App\Http\Controllers\Main;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    //添加
    public function create(){
        return view('Admin.create');
    }
    //验证属鸡的
    public function store(Request $request){
        //验证
        $this->validate($request,
            [
                'name'=>'required|min:2',
                'email'=>'required|email|unique:admins',
                'password'=>'required|confirmed|min:6',
            ],
            [
                'name.required'=>'请填写用户名!',
                'name.min'=>'用户名不能少于2个字符!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'邮箱格式不正确!',
                'email.unique'=>'邮箱已经存在!',
                'password.required'=>'请输入密码!',
                'password.confirmed'=>'2次密码不一致!',
                'password.min'=>'密码不能少于2个字符!',
            ]);
        //保存
        Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
        ]);
        //添加 成功!
        session()->flash('success','添加成功!');
        return redirect()->route('admin.index');
    }
    //管理员列表
    public function index(){
        $admins = Admin::all();
        return view('admin.index',compact('admins'));
    }
    //编辑-回显
    public function edit(Request $request,Admin $admin){
        return view('admin.edit',compact('admin'));
    }
    //编辑-保存
    public function update(Request $request,Admin $admin){
        //验证
        $this->validate($request,
            [
                'name'=>'required|min:2',
                'email'=>['required','email',
                    Rule::unique('admins')->ignore($admin->id)
                    ]
            ],
            [
                'name.required'=>'请填写用户名!',
                'name.min'=>'用户名不能少于2个字符!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'邮箱格式不正确!',
            ]);
        //保存
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('admin.index');
    }
    //删除
    public function destroy(Admin $admin){
        $admin->delete();
        echo  'success';
    }
    //修改密码
    public function modify(Request $request){
        if ($request->isMethod('post')){
            $this->validate($request,
                [
                    'oldpwd'=>'required',
                    'password'=>'required|min:6',
                    're_password'=>'required',
                ],
                [
                    'oldpwd.required'=>'请填写旧密码!',
                    'password.required'=>'请填写新密码!',
                    'password.min'=>'新密码不能少于6位!',
                    're_password.required'=>'请填写确认密码!',
                ]);
            //获取旧密码与新密码
            $oldpwd = $request->oldpwd;
            $newpwd = $request->password;
            //获取id
            $id = Auth::user()->id;
            //验证旧密码是否输入正确
            $rs = DB::table('admins')->where('id',$id)->select('password')->first();
            if (!Hash::check($oldpwd,$rs->password)){
                session()->flash('danger','旧密码输入错误!');
                return redirect()->route('modify');
                exit;//原密码不对
            };
            //验证新密码与确认密码是否一致
            if ($newpwd != $request->re_password){
                session()->flash('success','两次密码不一致!');
                return redirect()->route('modify');
            }else{
                DB::table('admins')->where('id',$id)->update(['password'=>bcrypt($newpwd)]);
                session()->flash('success','密码修改成功!请从新登陆!');
                Auth::logout();
                return redirect()->route('login');
            }
        }
        //展示修改密码表单
        return view('admin.modify');
    }
}
