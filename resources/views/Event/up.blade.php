@extends('layout.default')

@section('title','查看中奖名单')

    @section('content')
        <a href="{{route('event.index')}}" class="btn btn-sm btn-success">返回</a>
        <hr>
        <p>抽奖活动名称 : {{$title}}</p>
        中奖名单:
        <br>
        <p></p>
        @foreach($data as $value)
            <p>名称:{{$value->member_id}}&emsp;&emsp; 奖品:{{$value->name}} </p>
        @endforeach
        @stop