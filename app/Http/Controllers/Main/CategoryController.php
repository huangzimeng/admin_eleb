<?php

namespace App\Http\Controllers\Main;

use App\Category;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //添加分类
    public function create(){
        return view('category.create');
    }
    //保存分类
    public function store(Request $request){
        //验证
        $this->validate($request,
            [
                'name'=>'required|min:2|unique:categories',
                'logo'=>'required',
            ],
            [
                'name.required'=>'分类名称不能为空',
                'name.min'=>'名称不能少于2个字符',
                'name.unique'=>'名称已经存在',
                'logo.required'=>'请上传图片',
            ]);
        //保存
        Category::create([
            'name'=>$request->name,
            'logo'=>$request->logo,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('category.index');
    }
    //列表
    public function index(){
        $categorys = Category::all();
        return view('category.index',compact('categorys'))->render();
    }
    //编辑-回显
    public function edit(Category $category){
        return view('category.edit',compact('category'));
    }
    //编辑-保存
    public function update(Request $request,Category $category){
        //验证
        $this->validate($request,
            [
              'name'=>[
                  'required',
                  'min:2',
                  Rule::unique('categories')->ignore($category->id),
                  ]
            ],
            [
                'name.required'=>'名称不能为空!',
                'name.min'=>'名称不能少于2个字符'
            ]);
        //判断是否修改图片
        if ($request->logo == null){//不修改
            $filename = $category->logo;
        }else{//修改
            $filename = $request->logo;
        }
        $category->update([
            'name'=>$request->name,
            'logo'=>$filename,
        ]);

        session()->flash('success','修改成功!');
        return redirect()->route('category.index');
    }
    //删除
    public function destroy(Category $category){
        $category->delete();
        echo 'success';
    }
}
