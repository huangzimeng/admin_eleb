<?php

namespace App\Http\Controllers\Main;

use App\enent;
use App\Event_prize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//抽奖活动奖品控制器
class Event_prizeController extends Controller
{
    //添加 奖品
    public function create(){
        $events = enent::all();
        return view('event_prize.create',compact('events'));
    }
    //添加 保存
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!',
                'description.required'=>'详情不能为空!',
                'events_id.required'=>'请选择活动!',
            ]);
        Event_prize::create([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('event_prize.index');
    }
    //奖品 列表
    public function index(){
        $event_prizes = Event_prize::paginate(10);
        return view('event_prize.index',compact('event_prizes'));
    }
    //奖品 修改
    public function edit(Event_prize $event_prize){
        $events = enent::all();
        return view('event_prize.edit',compact('event_prize','events'));
    }
    //将品 修改
    public function update(Request $request,Event_prize $event_prize){
        $this->validate($request,
            [
                'name'=>'required',
                'description'=>'required',
                'events_id'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!',
                'description.required'=>'详情不能为空!',
                'events_id.required'=>'请选择活动!',
            ]);
        $event_prize->update([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('event_prize.index');
    }
    //奖品 删除
    public function destroy(Event_prize $event_prize){
        $id=$event_prize->id;
        $rs = DB::table('event_prizes')->where('id',$id)->select('member_id')->first();
        if ($rs->member_id == 0){//可以删除
            $event_prize->delete();
            echo "success";
        }else{
            echo 0;
        }
    }
}
