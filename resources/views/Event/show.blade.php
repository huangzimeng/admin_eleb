@extends('layout.default')

@section('title','查看抽奖详情')

    @section('content')
        <a href="{{route('event.index')}}" class="btn btn-sm btn-success">返回</a>
        <hr>
        <p>抽奖活动标题: {{$event->title}}</p>
        <p>抽奖活动内容: {{$event->contents}}</p>
        <p>开始时间: {{$event->signup_start}}</p>
        <p>结束时间: {{$event->signup_end}}</p>
        <p>开奖时间: {{$event->prize_date}}</p>
        <br>
        @foreach($members as $member)
        <p>已报名店铺
            &emsp;店铺名称:{{$member->shop_name}}
            &emsp;店铺图片: <img src="{{$member->shop_img}}" width="80px">
            &emsp;店铺地址:{{$member->address}}</p>
        @endforeach
        <br>
        @foreach($prizes as $prize)
        <p>奖品: {{$prize->name}}</p>
        @endforeach
        @stop