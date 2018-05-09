@extends('layout.default')

@section('title','查看奖品')

    @section('content')
        <a href="{{route('event.index')}}" class="btn btn-sm btn-success">返回</a>
        <a href="{{route('event_prize.create')}}" class="btn btn-sm btn-primary">添加奖品</a>
        <table class="table">
            <tr>
                <td>ID</td>
                <td>奖品名称</td>
            </tr>
            @foreach($prizes as $prize)
                <tr>
                    <td>{{$prize->id}}</td>
                    <td>{{$prize->name}}</td>
                </tr>
            @endforeach
        </table>
        @stop