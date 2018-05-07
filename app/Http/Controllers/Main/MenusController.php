<?php

namespace App\Http\Controllers\Main;

use App\Menu;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//菜单管理
class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //无限极分类
    protected function getChildren($list,$parent_id=0,$deep=0){
        static $children = [];
        foreach ($list as $child){
            if ($child['parent_id'] == $parent_id){
                $child->deep = $deep;
                $child->name = str_repeat('---',$deep).$child->name;
                $children[] = $child;
                $this->getChildren($list,$child->id,$deep+1);
            }
        }
        return $children;
    }
    //添加 菜单
    public function create(){
        $permission = Permission::all();
        $menus = Menu::where('parent_id',0)->get();
        return view('Menu.create',compact('menus','permission'));
    }
    //保存
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:menus',
                'parent_id'=>'required',
                'address'=>'required',
                'sort'=>'required',
            ],
            [
                'name.required'=>'请填写名称!',
                'name.unique'=>'名称已经存在!',
                'parent_id.required'=>'请选择上级菜单!',
                'address.required'=>'请填写地址!',
                'sort.required'=>'请填写排序!',
            ]);
        Menu::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'address'=>$request->address,
            'sort'=>$request->sort,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('menu.index');
    }
    //菜单 列表
    public function index(){
        $menus = Menu::all();
        $data = $this->getChildren($menus);
        return view('menu.index',compact('data'));
    }
    //菜单 修改
    public function edit(Menu $menu){
        $permissions=Permission::all();
        $data = Menu::all();
        return view('menu.edit',compact('menu','data','permissions'));
    }
    //修改 保存
    public function update(Request $request,Menu $menu){
        $this->validate($request,
            [
                'name'=>[
                    'required',
                    Rule::unique('menus')->ignore($menu->id)
                ],
                'address'=>'required',
                'sort'=>'required',
            ],
            [
                'name.required'=>'请填写名称!',
                'name.unique'=>'名称已经存在!',
                'address.required'=>'请填写地址!',
                'sort.required'=>'请填写排序!',
            ]);
        $menu->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'sort'=>$request->sort,
            'parent_id'=>$request->parent_id,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('menu.index');
    }
}
