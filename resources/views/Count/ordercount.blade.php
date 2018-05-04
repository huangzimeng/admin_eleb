@extends('layout.default')

@section('title','品台订单统计')

    @section('content')
        <form method="get" action="" class="form-inline">
            <div class="form-group">
                <label for="exampleInputEmail1">开始日期</label>
                <input type="date" name="start_time" value="{{old('start_time')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">结束日期</label>
                <input type="date" name="end_time" value="{{old('end_time')}}">
            </div>
            <button type="submit" class="btn btn-default">查询</button>
        </form> <p></p>
        <div class="row">
            <div class="col-sm-3">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" style="text-align: center">查询(默认为当天订单数)</td>
                    </tr>
                    @foreach($counts as $value)
                        <tr>
                            <td>{{$value->shop_name}}</td>
                            <td>{{$value->num."份"}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>总计</td>
                        <td>{{$counts_total[0]->num."份"}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-3">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" style="text-align: center">当天订单数</td>
                    </tr>
                    @foreach($day as $value)
                        <tr>
                            <td>{{$value->shop_name}}</td>
                            <td>{{$value->num."份"}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>总计</td>
                        <td>{{$day_total[0]->num."份"}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-3">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" style="text-align: center">当月订单数</td>
                    </tr>
                    @foreach($month as $value)
                        <tr>
                            <td>{{$value->shop_name}}</td>
                            <td>{{$value->num."份"}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>总计</td>
                        <td>{{$month_total[0]->num."份"}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-3">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" style="text-align: center">累计订单数</td>
                    </tr>
                    @foreach($all as $value)
                        <tr>
                            <td>{{$value->shop_name}}</td>
                            <td>{{$value->num."份"}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>总计</td>
                        <td>{{$all_total[0]->num."份"}}</td>
                    </tr>
                </table>
            </div>
        </div>
        @stop