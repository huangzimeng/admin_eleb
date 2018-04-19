<?php

namespace App\Http\Controllers\Main;

use App\Category;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //添加分类
    public function create(){
        return view('Category.create');
    }
    //保存分类
    public function store(Request $request,ImageUploadHandler $uploader){
        //验证
        $this->validate($request,
            [
                'name'=>'required|min:2|unique:categories',
            ],
            [
                'name.required'=>'分类名称不能为空',
                'name.min'=>'名称不能少于2个字符',
                'name.unique'=>'名称已经存在'
            ]);
        //保存图片
        $filename = $uploader->save($request->logo,'logo',1);
        //保存
        Category::create([
            'name'=>$request->name,
            'logo'=>$filename['path'],
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('category.index');
    }
    //列表
    public function index(){
        $categorys = Category::all();
        return view('category.index',compact('categorys'));
    }
    //编辑-回显
    public function edit(Category $category){
        return view('category.edit',compact('category'));
    }
    //编辑-保存
    public function update(Request $request,Category $category,ImageUploadHandler $uploader){
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
            $a = $uploader->save($request->logo,'logo',1);
            $filename=$a['path'];
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
