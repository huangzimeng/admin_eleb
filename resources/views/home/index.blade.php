@extends('layout.default')

@section('title','后台首页')

    @section('content')
        <p style="text-align: center;font-size: larger">店铺申请列表</p>
        @permission('home.create')
        <a href="{{route('home.create')}}" class="btn btn-sm btn-primary">添加店铺</a>
        @endpermission
        <table class="table table-responsive">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>邮箱</td>
                <td>店铺状态</td>
                <td>账号状态</td>
                @permission('home.show|disabled|enable')
                <td>操作</td>
                @endpermission
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
                    @permission('home.show')
                    <a href="{{route('home.show',['shopuser'=>$shopuser])}}" class="btn btn-primary btn-sm">查看店铺详情</a>
                    @endpermission

                    @if($shopuser->status)
                        @permission('disabled')
                        <a href="{{route('disabled',['shopuser'=>$shopuser])}}"  class="btn btn-sm btn-danger">禁用账号</a>
                        @endpermission
                    @else
                        @permission('enable')
                        <a href="{{route('enable',['shopuser'=>$shopuser])}}"  class="btn btn-sm btn-danger">启用账号</a>
                        @endpermission
                    @endif


                </td>
            </tr>
            @endforeach
        </table>
        @stop