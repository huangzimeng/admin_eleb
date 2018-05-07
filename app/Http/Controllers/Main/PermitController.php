<?php

namespace App\Http\Controllers\Main;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//权限管理
class PermitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //添加  权限
    public function create(){
        return view('permit.create');
    }
    //保存  权限
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:permissions',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'权限名称不能为空!!!',
                'name.unique'=>'权限名称不能重复!!!',
                'display_name.required'=>'显示名称不能为空!!!',
                'description.required'=>'描述名称不能为空!!!',
            ]);
        Permission::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('permit.index');
    }
    //权限  列表
    public function index(){
        $permissions = Permission::orderBy('id','desc')->Paginate(8);
        return view('permit.index',compact('permissions'));
    }
    //编辑  回显
    public function edit(Permission $permit){
        return view('permit.edit',compact('permit'));
    }
    //编辑  保存
    public function update(Request $request,Permission $permit){
        $this->validate($request,
            [
                'name'=>['required',Rule::unique('permissions')->ignore($permit->id)],
                'display_name'=>['required',Rule::unique('permissions')->ignore($permit->id)],
                'description'=>['required',Rule::unique('permissions')->ignore($permit->id)],
            ],
            [
                'name.required'=>'权限名称不能为空!!!',
                'name.unique'=>'权限名称重复!!!',

                'display_name.required'=>'显示名称不能为空!!!',
                'display_name.unique'=>'显示名称不能重复!!!',

                'description.required'=>'描述名称不能为空!!!',
                'description.unique'=>'描述名称不能重复!!!',
            ]);
        $permit->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('permit.index');
    }
    //权限  删除
    public function destroy(Permission $permit){
        $permit->delete();
        echo "success";
    }
}
