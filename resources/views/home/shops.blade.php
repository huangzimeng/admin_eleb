@extends('layout.default')

@section('title','店铺列表')

    @section('content')
        <h3 style="text-align: center">商家店铺列表</h3>
        <form action="" method="get">
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Go!</button>
      </span>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-responsive table-bordered">
            <tr>
                <td>ID</td>
                <td>店铺名称</td>
                <td>店铺图片</td>
                <td>地址</td>
                <td>邮箱</td>
                <td>是否品牌</td>
                <td>是否准时达</td>
                <td>是否蜂鸟配送</td>
                <td>是否包标记</td>
                <td>是否票标记</td>
                <td>是否准标记</td>
                <td>公告</td>
                <td>优惠信息</td>
                <td>状态</td>
            </tr>
            @foreach($shops as $shop)
                <tr>
                    <td>{{$shop->id}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td><img src="{{$shop->shop_img}}" alt="" width="80px"></td>
                    <td>{{$shop->address}}</td>
                    <td>{{$shop->email}}</td>
                    <td>{{$shop->brand==1?"√":'×'}}</td>
                    <td>{{$shop->on_time==1?"√":'×'}}</td>
                    <td>{{$shop->fengniao==1?"√":'×'}}</td>
                    <td>{{$shop->bao==1?"√":'×'}}</td>
                    <td>{{$shop->piao==1?"√":'×'}}</td>
                    <td>{{$shop->zhun==1?"√":'×'}}</td>
                    <td>{{$shop->notice==1?"√":'×'}}</td>
                    <td>{{$shop->discount==1?"√":'×'}}</td>
                    <td>{{$shop->status==1?'正常':'禁用'}}</td>
                </tr>
            @endforeach
        </table>
        @stop