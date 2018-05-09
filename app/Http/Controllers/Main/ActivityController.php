<?php

namespace App\Http\Controllers\Main;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //创建活动
    public function create(){
        if(!Auth::user()->can('activity.create')){
            return view('error.nopage');
        }
        return view('activity.create');
    }
    //保存
    public function store(Request $request){
        if(!Auth::user()->can('activity.create')){
            return view('error.nopage');
        }
        $this->validate($request,
            [
                'name'=>'required|unique:activities',
                'contents'=>'required',
                'start'=>'required',
                'end'=>'required',
            ],
            [
                'name.required'=>'请填写名称!',
                'name.unique'=>'名称已经存在!',
                'contents.required'=>'请填写内容!',
                'start.required'=>'请填写开始时间!',
                'end.required'=>'请填写结束时间!',
            ]);

        $now = time();//现在的时间
        $start = strtotime($request->start);
        $end = strtotime($request->end);
        if ($now>$start){
            session()->flash('danger','开始时间不能小于现在的时间!');
            return back()->withInput();
        }
        if ($now>$end){
            session()->flash('danger','活动结束时间不能小于现在时间!');
            return back()->withInput();
        }
        if ($start>$end){
            session()->flash('danger','活动开始时间不能大于结束时间!');
            return back()->withInput();
        }
        //保存
        Activity::create([
            'name'=>$request->name,
            'contents'=>html_entity_decode($request->contents),
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('activity.index');
    }
    //列表
    public function index(){
        if(!Auth::user()->can('activity.index')){
            return view('error.nopage');
        }
        $now = Carbon::now();
        $activitys = Activity::all();
        return view('activity.index',compact('activitys','now'));
//        $contents = view('activity.index',compact('activitys','now'))->render();
////        return $contents;
//        file_put_contents('../resources/views/static/activitylist.html',$contents);
//        echo "页面静态化完成!";
    }
    //查看
    public function show(Activity $activity){
        if(!Auth::user()->can('activity.show')){
            return view('error.nopage');
        }
        return view('activity.show',compact('activity'));
    }
    //活动-编辑
    public function edit(Activity $activity){
        if(!Auth::user()->can('activity.edit')){
            return view('error.nopage');
        }
        return view('activity.edit',compact('activity'));
    }
    //编辑-保存
    public function update(Request $request,Activity $activity){
        if(!Auth::user()->can('activity.edit')){
            return view('error.nopage');
        }
        $this->validate($request,
            [
                'name'=>[
                    'required',
                    Rule::unique('activities')->ignore($activity->id),
                ],
                'contents'=>'required',
                'start'=>'required',
                'end'=>'required',
            ],
            [
                'name.required'=>'请填写名称!',
                'name.unique'=>'名称已经存在!',
                'contents.required'=>'请填写内容!',
                'start.required'=>'请填写开始时间!',
                'end.required'=>'请填写结束时间!',
            ]);
        $now = time();//现在的时间
        $start = strtotime($request->start);
        $end = strtotime($request->end);
        if ($now>$start){
            session()->flash('danger','开始时间不能小于现在的时间!');
            return back()->withInput();
        }
        if ($now>$end){
            session()->flash('danger','活动结束时间不能小于现在时间!');
            return back()->withInput();
        }
        if ($start>$end){
            session()->flash('danger','活动开始时间不能大于结束时间!');
            return back()->withInput();
        }
        $activity->update([
            'name'=>$request->name,
            'contents'=>$request->contents,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('activity.index');
    }
    //删除
    public function destroy(Activity $activity){
        if(!Auth::user()->can('activity.destroy')){
            return view('error.nopage');
        }
        $activity->delete();
        echo "success";
    }
}
