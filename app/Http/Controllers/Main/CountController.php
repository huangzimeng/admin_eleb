<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //订单量统计
    public function order_count(Request $request){
        //查询当天的统计
        $day1 = date('Y-m-d')." 00:00:00";
        $day2 = date('Y-m-d')." 23:59:59";
        $day_total = DB::select("SELECT SUM(amount) as num from order_goods where created_at>'{$day1}' AND created_at<'{$day2}'");
        $day = DB::select("SELECT num,shop_name,shop_id FROM ( SELECT SUM(amount) as num,shop_id,order_birth_time 
from orders as o JOIN  order_goods as og on o.id=og.order_id  
WHERE order_birth_time > '{$day1}' AND order_birth_time < '{$day2}' 
GROUP BY shop_id ) AS o
JOIN store_infos AS si ON (o.shop_id = si.id) GROUP BY num DESC;");

        //查询当月的统计
        $month1 = date('Y-m')."-01 00:00:00";//第一天
        $month2 = date('Y-m-t')." 23:59:59";//最后一天
        $month_total = DB::select("SELECT SUM(amount) as num from order_goods where created_at>'{$month1}' AND created_at<'{$month2}'");
        $month = DB::select("SELECT num,shop_name,shop_id FROM ( SELECT SUM(amount) as num,shop_id,order_birth_time 
from orders as o JOIN  order_goods as og on o.id=og.order_id  
WHERE order_birth_time > '{$month1}' AND order_birth_time < '{$month2}' 
GROUP BY shop_id ) AS o
JOIN store_infos AS si ON (o.shop_id = si.id) GROUP BY num DESC;");

        //查询累计的统计
        $all_total = DB::select("SELECT SUM(amount) as num from order_goods");
        $all = DB::select("SELECT num,shop_name,shop_id FROM ( SELECT SUM(amount) as num,shop_id,order_birth_time 
from orders as o JOIN  order_goods as og on o.id=og.order_id  
GROUP BY shop_id ) AS o
JOIN store_infos AS si ON (o.shop_id = si.id) GROUP BY num DESC;");

        //按条件查询(默认为当天)
        $start = $request->start_time??$day1;
        $end = $request->end_time??$day2;
        if ($start && $end){
            if ($start == $end){
                $end = $end." 23:59:59";
            }
            $counts_total = DB::select("SELECT SUM(amount) as num from order_goods where created_at>'{$start}' AND created_at<'{$end}'");
            $counts = DB::select("SELECT num,shop_name,shop_id FROM ( SELECT SUM(amount) as num,shop_id,order_birth_time 
from orders as o JOIN  order_goods as og on o.id=og.order_id  
WHERE order_birth_time > '{$start}' AND order_birth_time < '{$end}' 
GROUP BY shop_id ) AS o
JOIN store_infos AS si ON (o.shop_id = si.id) GROUP BY num DESC;");
        }

        return view('Count.ordercount',compact('day','day_total','month','month_total','all','all_total','counts','counts_total'));
    }
    //店铺菜品销量统计
    public function goods_count(Request $request){
        //统计当天店铺菜品销量
        $day1 = date('Y-m-d')." 00:00:00";
        $day2 = date('Y-m-d')." 23:59:59";
        $day = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select('store_infos.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('store_infos.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->where([
                ['order_goods.created_at','>',$day1],
                ['order_goods.created_at','<',$day2],
                ['orders.order_status','<>',-1]
            ])
            ->get();
        $day_total = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select(DB::raw('sum(order_goods.amount) as amounts'))
            ->where([
                ['order_goods.created_at','>',$day1],
                ['order_goods.created_at','<',$day2],
                ['orders.order_status','<>',-1]
            ])
            ->get();

        //统计当月店铺菜品销量
        $month1 = date('Y-m')."-01 00:00:00";//第一天
        $month2 = date('Y-m-t')." 23:59:59";//最后一天
        $month = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select('store_infos.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('store_infos.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->where([
                ['order_goods.created_at','>',$month1],
                ['order_goods.created_at','<',$month2],
                ['orders.order_status','<>',-1]
            ])
            ->get();
        $month_total = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select(DB::raw('sum(order_goods.amount) as amounts'))
            ->where([
                ['order_goods.created_at','>',$month1],
                ['order_goods.created_at','<',$month2],
                ['orders.order_status','<>',-1]
            ])
            ->get();

        //统计累计店铺销量
        $all = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select('store_infos.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
            ->groupBy('store_infos.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
            ->orderBy('amounts','desc')
            ->where([
                ['orders.order_status','<>',-1]
            ])
            ->get();
        $all_total = DB::table('order_goods')
            ->join('orders','order_goods.order_id','=','orders.id')
            ->join('store_infos','orders.shop_id','=','store_infos.id')
            ->select(DB::raw('sum(order_goods.amount) as amounts'))
            ->where([
                ['orders.order_status','<>',-1]
            ])
            ->get();

        //按条件查询(默认为当天)
        //按条件查询(默认为当天)
        $start = $request->start_time??$day1;
        $end = $request->end_time??$day2;
        if ($start && $end){
            if ($start == $end){
                $end = $end." 23:59:59";
            }
            $counts = DB::table('order_goods')
                ->join('orders','order_goods.order_id','=','orders.id')
                ->join('store_infos','orders.shop_id','=','store_infos.id')
                ->select('store_infos.shop_name','orders.shop_id','order_goods.goods_name','order_goods.goods_id',DB::raw('sum(order_goods.amount) as amounts'))
                ->groupBy('store_infos.shop_name','orders.shop_id','order_goods.goods_id','order_goods.goods_name')
                ->orderBy('amounts','desc')
                ->where([
                    ['order_goods.created_at','>',$start],
                    ['order_goods.created_at','<',$end],
                    ['orders.order_status','<>',-1]
                ])
                ->get();

            $counts_total = DB::table('order_goods')
                ->join('orders','order_goods.order_id','=','orders.id')
                ->join('store_infos','orders.shop_id','=','store_infos.id')
                ->select(DB::raw('sum(order_goods.amount) as amounts'))
                ->where([
                    ['order_goods.created_at','>',$start],
                    ['order_goods.created_at','<',$end],
                    ['orders.order_status','<>',-1]
                ])
                ->get();
        }
        return view('Count.goodscount',compact('day','day_total','month','month_total','all','all_total','counts','counts_total'));
    }
}
