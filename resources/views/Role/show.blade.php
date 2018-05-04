@extends('layout.default')

@section('title','查看角色')

    @section('content')
        <a href="{{route('role.index')}}" class="btn btn-primary btn-sm">返回</a>
        <p style="margin-top: 20px">角色名称: {{$role->name}}</p>
        <p style="margin-top: 20px">描述: {{$role->display_name}}</p>
        <p style="margin-top: 20px">权限:
        @foreach($permissions as $permission)
            <li>{{$permission->display_name}}</li>
        @endforeach
        </p>
        @stop