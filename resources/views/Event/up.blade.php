@extends('layout.default')

@section('title','查看中奖名单')

    @section('content')
        <a href="{{route('event.index')}}" class="btn btn-sm btn-success">返回</a>
        <hr>
        中奖名单有:
        <br>
        <p></p>
        @foreach($name as $value)
            <p>{{$value->shop_name}}</p>
        @endforeach
        @stop