@extends('layout.default')

@section('title','会员列表')

    @section('content')
        <h3 style="text-align: center">会员列表</h3>
        <table class="table table-responsive">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>电话</td>
                <td>状态</td>
                <td>操作</td>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->tel}}</td>
                <td>{{$user->status==1?'正常':'被禁用'}}</td>
                <td>
                    <a href="{{route('down',['user'=>$user])}}" class="btn btn-primary btn-sm">
                        @if($user->status==1) 禁用
                        @else 启用
                        @endif
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
        @stop