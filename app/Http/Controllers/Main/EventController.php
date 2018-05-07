<?php

namespace App\Http\Controllers\Main;

use App\enent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\Rule;

//抽奖活动
class EventController extends Controller
{
    //添加 抽奖
    public function create(){
        return view('Event.create');
    }
    //添加 保存
    public function store(Request $request){
        $this->validate($request,
            [
                'title'=>'required|unique:enents',
                'contents'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required|numeric',
            ],
            [
                'title.required'=>'标题不能为空!!!',
                'contents.required'=>'内容不能为空!!!',
                'title.unique'=>'抽奖名称已经存在!!!',
                'signup_start.required'=>'开始报名时间不能为空!!!',
                'signup_end.required'=>'结束报名时间不能为空!!!',
                'prize_date.required'=>'开奖时间不能为空!!!',
                'signup_num.required'=>'报名人数限制不能为空!!!',
                'signup_num.numeric'=>'报名人数必须为数字!!!',
            ]);
        $now = time();//现在的时间
        $start = strtotime($request->signup_start);
        $end = strtotime($request->signup_end);
        if ($now>$start){
            session()->flash('danger','抽奖开始时间错误,抽奖开始时间不能小于现在的时间!');
            return back()->withInput();
        }
        if ($now>$end){
            session()->flash('danger','抽奖结束时间错误,抽奖结束时间不能小于现在时间!');
            return back()->withInput();
        }
        if ($start>$end){
            session()->flash('danger','抽奖开始时间错误,抽奖开始时间不能大于抽奖结束时间!');
            return back()->withInput();
        }
        if ($end<$request->prize_date){
            session()->flash('danger','开奖时间错误,开奖时间不能小于抽奖结束时间');
            return back()->withInput();
        }
        enent::create([
            'title'=>$request->title,
            'contents'=>$request->contents,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('event.index');
    }
    //抽奖  列表
    public function index(){
        $events = enent::all();
        return view('Event.index',compact('events'));
    }
    //查看 抽奖
    public function show(enent $event){
        $rs = DB::table('event_members')->where('events_id',$event->id)->get();
        $members = [];
        foreach ($rs as $val){
            $result = DB::table('store_infos')->where('id',$val->member_id)->first();
            $members[] = $result;
        }
        $prizes = DB::table('event_prizes')->where('events_id',$event->id)->select('name')->get();
        return view('Event.show',compact('event','members','prizes'));
    }
    //编辑 抽奖
    public function edit(enent $event){
        return view('Event.edit',compact('event'));
    }
    //编辑 保存
    public function update(Request $request,enent $event){
        $this->validate($request,
            [
                'title'=>[
                    'required',
                    Rule::unique('enents')->ignore($event->id)
                ],
                'contents'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required|numeric',
            ],
            [
                'title.required'=>'标题不能为空!!!',
                'title.unique'=>'抽奖名称已经存在!!!',
                'contents.required'=>'内容不能为空!!!',
                'signup_start.required'=>'开始报名时间不能为空!!!',
                'signup_end.required'=>'结束报名时间不能为空!!!',
                'prize_date.required'=>'开奖时间不能为空!!!',
                'signup_num.required'=>'报名人数限制不能为空!!!',
                'signup_num.numeric'=>'报名人数必须为数字!!!',
            ]);
        $now = time();//现在的时间
        $start = strtotime($request->signup_start);
        $end = strtotime($request->signup_end);
        if ($now>$start){
            session()->flash('danger','抽奖开始时间错误,抽奖开始时间不能小于现在的时间!');
            return back()->withInput();
        }
        if ($now>$end){
            session()->flash('danger','抽奖结束时间错误,抽奖结束时间不能小于现在时间!');
            return back()->withInput();
        }
        if ($start>$end){
            session()->flash('danger','抽奖开始时间错误,抽奖开始时间不能大于抽奖结束时间!');
            return back()->withInput();
        }
        if ($end<$request->prize_date){
            session()->flash('danger','开奖时间错误,开奖时间不能小于抽奖结束时间');
            return back()->withInput();
        }
        $event->update([
            'title'=>$request->title,
            'contents'=>$request->contents,
            'signup_start'=>$request->signup_start,
            'signup_end'=>$request->signup_end,
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('event.index');
    }
    //删除 抽奖
    public function destroy(enent $event){
        $event->delete();
        echo "success";
    }
    //开始 抽奖
    public function start_prize(enent $start_prize){
        if ($start_prize->is_prize){
            session()->flash('danger','已经开奖!!!不能再开奖!!!');
            return redirect()->back();
        }
        $start = $start_prize->signup_start." 00:00:00";
        if (date('Y-m-d H:i:s') < $start){
            session()->flash('danger','未到开奖时间!不能开奖!!!');
            return redirect()->back();
        }

        //查询报名人员名单并打乱
        $members = DB::table('event_members')->where('events_id',$start_prize->id)->pluck('member_id')->shuffle();
        //奖品打乱
        $prizes = DB::table('event_prizes')->where('events_id',$start_prize->id)->pluck('id')->shuffle();
        //配对
        $result = [];
        foreach ($members as $member_id){
            $prize_id = $prizes->pop();
            if ($prize_id == null) break;
            $result[$prize_id] = $member_id;
        }
        //dd($result); // eg: 41 => 7 (奖品id=>中奖人id)
        DB::transaction(function ()use ($result,$start_prize) {
            foreach ($result as $pid=>$mid){
                DB::table('event_prizes')
                ->where('id',$pid)
                ->update(['member_id'=>$mid]);
            }
            //修改活动状态
            $start_prize->is_prize=1;
            $start_prize->save();
        });
        session()->flash('success','开奖成功!');
        return redirect()->back();
    }
    //查看中奖名单
    public function show_members(enent $show_members){
        //抽奖活动id : $show_members->id
        //活动标题
        $title = $show_members->title;
        //查询中奖人及奖品名单
        $data = DB::table('event_prizes')
            ->where([
                ['events_id','=',$show_members->id],
                ['member_id','<>',0],
            ])
            ->get();
        foreach ($data as $value){
            $b = DB::table('store_infos')->where('id',$value->member_id)->first();
            $value->member_id = $b->shop_name;
        }
        return view('Event.up',compact('data','title'));
    }
}
