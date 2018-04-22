@extends('layout.default')

@section('title','查看店铺详细信息')

@section('content')
    <a href="{{route('home.index')}}" class=" btn btn-sm btn-info">返回</a>
    @if($storeinfo->status) 已审核通过
    @else 未审核
    @endif

    @if(!$storeinfo->status)
        <a href="{{route('review',['storeinfo'=>$storeinfo->id])}}" class="btn btn-link">通过审核</a>
    @endif
    <div style="height: 20px"></div>
    <table class="table table-hover">
        <tr>
            <td>店铺名称:&emsp;</td>
            <td>{{$storeinfo->shop_name}}</td>
        </tr>
        <tr>
            <td>图片:&emsp;</td>
            <td><img src="{{$storeinfo->shop_img}}" width="80px"></td>
        </tr>
        <tr>
            <td>店铺地址:&emsp;</td>
            <td>{{$storeinfo->address}}</td>
        </tr>
        <tr>
            <td>是否是品牌:&emsp;</td>
            <td>@if($storeinfo->brand) √ @else × @endif </td>
        </tr>
        <tr>
            <td>是否准时达:&emsp;</td>
            <td>@if($storeinfo->on_time) √ @else × @endif</td>
        </tr>
        <tr>
            <td>是否蜂鸟配送:&emsp;</td>
            <td>@if($storeinfo->fengniao) √ @else × @endif</td>
        </tr>
        <tr>
            <td>是否保标记:&emsp;</td>
            <td>@if($storeinfo->bao) √ @else × @endif</td>
        </tr>
        <tr>
            <td>是否票标记:&emsp;</td>
            <td>@if($storeinfo->piao) √ @else × @endif</td>
        </tr>
        <tr>
            <td>是否准标记:&emsp;</td>
            <td>@if($storeinfo->zhun) √ @else × @endif</td>
        </tr>
        <tr>
            <td>起送金额:&emsp;</td>
            <td>{{$storeinfo->start_send}}</td>
        </tr>
        <tr>
            <td>配送费:&emsp;</td>
            <td>{{$storeinfo->send_cost}}</td>
        </tr>
        <tr>
            <td>店铺公告:&emsp;</td>
            <td>{{$storeinfo->notice}}</td>
        </tr>
        <tr>
            <td>优惠信息:&emsp;</td>
            <td>{{$storeinfo->discount}}</td>
        </tr>
    </table>
@stop