@extends('layout.default')

@section('title','后台首页')

    @section('content')
        <p style="text-align: center;font-size: larger">店铺申请列表</p>
        <a href="{{route('home.create')}}" class="btn btn-sm btn-primary">添加店铺</a>
        <table class="table table-responsive">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>邮箱</td>
                <td>店铺状态</td>
                <td>账号状态</td>
                <td>操作</td>
            </tr>
            @foreach($shopusers as $shopuser)
            <tr>
                <td>{{$shopuser->id}}</td>
                <td>{{$shopuser->name}}</td>
                <td>{{$shopuser->email}}</td>
                <td>
                    @if($shopuser->storeinfo->status) 店铺审核通过
                    @else 店铺审核未通过
                    @endif
                </td>
                <td>
                    @if($shopuser->status) 店铺账号可用
                    @else 店铺账号不可以
                    @endif
                </td>
                <td>
                    <a href="{{route('home.show',['shopuser'=>$shopuser])}}" class="btn btn-primary btn-sm">查看店铺详情</a>
                    @if($shopuser->status)
                        <a href="{{route('disabled',['shopuser'=>$shopuser])}}"  class="btn btn-sm btn-danger">禁用账号</a>
                    @else
                        <a href="{{route('enable',['shopuser'=>$shopuser])}}"  class="btn btn-sm btn-danger">启用账号</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        @stop