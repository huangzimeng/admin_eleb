@extends('layout.default')

@section('title','查看列表')

@section('content')
    <a href="{{route('activity.index')}}" class="btn btn-sm btn-info">返回</a>
    <p style="padding-top: 20px">活动名称 : {{$activity->name}}</p>
    <p style="padding-top: 20px">活动内容 : {!!$activity->contents!!}</p>
    <p style="padding-top: 20px">活动开始时间 : {{$activity->start}}</p>
    <p style="padding-top: 20px">活动结束时间 : {{$activity->end}}</p>
@stop
@section('js')
@stop
