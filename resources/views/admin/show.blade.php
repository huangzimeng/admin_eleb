@extends('layout.default')

@section('title','查看管理员')

    @section('content')
        <a href="{{route('admin.index')}}" class="btn btn-sm btn-primary">返回</a>
        <h4>管理员名称: {{$admin->name}}</h4>
        <h4>管理员邮箱: {{$admin->email}}</h4>
        <h4>
            角色 :
        @foreach($admin->roles as $value)
           {{$value->display_name}} &emsp;
        @endforeach
        </h4>
    @stop