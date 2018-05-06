@extends('layout.default')

@section('title','添加抽奖活动')

    @section('content')
        <form method="post" action="{{route('event.store')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">活动标题</label>
                <input type="text" name="title" value="{{old('titlse')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">活动内容</label>
                <input type="text" name="contents" value="{{old('contents')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">开始报名时间</label>
                <input type="date" name="signup_start" value="{{old('signup_start')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">结束报名时间</label>
                <input type="date" name="signup_end" value="{{old('signup_end')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">开奖日期</label>
                <input type="date" name="prize_date" value="{{old('prize_date')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">报名人数限制</label>
                <input type="text" name="signup_num" value="{{old('signup_num')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
            {{csrf_field()}}
        </form>

    @stop