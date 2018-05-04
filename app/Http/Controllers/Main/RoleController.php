<?php

namespace App\Http\Controllers\Main;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//权限管理
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //添加  角色
    public function create(){
        $permissions = Permission::all();
        return view('Role.create',compact('permissions'));
    }
    //保存  角色
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:roles',
                'display_name'=>'required',
                'description'=>'required',
                'role'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!!!',
                'name.unique'=>'名称已经存在!!!',
                'display_name.required'=>'显示名称不能为空!!!',
                'description.required'=>'描述不能为空!!!',
                'role.required'=>'权限不能为空!!!',
            ]);
        //保存角色
        $owner = new Role();
        $owner->name=$request->name;
        $owner->display_name=$request->display_name;
        $owner->description=$request->description;
        $owner->save();
//        $owner->attachPermissions($request->role);//可行
        $owner->permissions()->attach($request->role);//可行
        session()->flash('success','添加成功!');
        return redirect()->route('role.index');
    }
    //角色  列表
    public function index(){
        $roles = Role::all();
        return view('Role.index',compact('roles'));
    }
    //角色  查看
    public function show(Role $role){
        $permissions = DB::table('permissions')
            ->join('permission_role','permissions.id','=','permission_role.permission_id')
            ->select('permissions.display_name')
            ->where('permission_role.role_id',$role->id)
            ->get();
        return view('Role.show',compact('role','permissions'));
    }
    //修改  回显
    public function edit(Role $role){
//        $b = [];
//        $a= $role->permissions;
//        foreach ($a as $value){
//            $b[] = $value->id;
//        }
        $rows = DB::table('permission_role')->where('role_id',$role->id)->select('permission_id')->get();
        $permissionss = Permission::all();
        return view('Role.edit',compact('role','permissionss','rows'));
    }
    //修改  保存
    public function update(Request $request,Role $role){
        $this->validate($request,
            [
                'name'=>['required',Rule::unique('roles')->ignore($role->id)],
                'display_name'=>'required',
                'description'=>'required',
                'role'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!!!',
                'name.unique'=>'名称已经存在!!!',
                'display_name.required'=>'显示名称不能为空!!!',
                'description.required'=>'描述不能为空!!!',
                'role.required'=>'权限不能为空!!!',
            ]);
        //修改保存
        $role->syncPermissions($request->role);
//        $role->permissions()->sync($request->role);//可行
        session()->flash('success','修改成功!');//可行
        return redirect()->route('role.index');
    }
    //删除
    public function destroy(Role $role){
        $role->detachPermissions();
        $role->delete();
        echo  "success";
    }
}
