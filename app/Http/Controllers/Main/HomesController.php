<?php

namespace App\Http\Controllers\Main;

use App\Category;
use App\Handlers\ImageUploadHandler;
use App\Search;
use App\ShopUser;
use App\SphinxClient;
use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //添加商家
    public function create(){
        $category  = Category::all();
        return view('home.create',compact('category'));
    }
    //保存数据
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|min:2',
                'shop_img'=>'required',
                'email'=>'required|email',
                'password'=>'required|confirmed|min:10',
                'start_send' => 'required|numeric',
                'send_cost' => 'required|numeric',
                'notice' => 'required',
                'discount' => 'required',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'piao' => 'required',
                'zhun' => 'required',
                'address'=>'required',
                'category_id'=>'required'
            ],
            [
                'name.required'=>'店铺名称不能为空!',
                'name.min'=>'店铺名称不能少于2个字符!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'邮箱格式不正确!',
                'password.required'=>'密码不能为空!',
                'password.confirmed'=>'两次密码必须一致!',
                'password.min'=>'密码不能少于10位!',
                'shop_name.required' => '店铺名称不能为空!',
                'shop_name.min' => '店铺名称不能少于4个字符!',
                'start_send.required' => '起送金额不能为空!',
                'start_send.numeric' => '起送金额必须为数字!',
                'send_cost.required' => '配送费不能为空!',
                'send_cost.numeric' => '配送费必须为数字!',
                'notice.required' => '公告不能为空!',
                'discount.required' => '优惠活动不能为空!',
                'brand.required' => '请选择品牌!',
                'on_time.required' => '请选择是否准时达!',
                'fengniao.required' => '请选择是否是蜂鸟配送!',
                'bao.required' => '请选择是否保标记!',
                'piao.required' => '请选择是否票标记!',
                'zhun.required' => '请选择是否准标记!',
                'address.required'=>'请填写地址',
                'required.required'=>'请选择分类',
                'shop_img.required'=>'请上传图片',
            ]);
        DB::beginTransaction();//开启事务
        try{
            $storeinfo = StoreInfo::create([
                'shop_name'=>$request->name,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'address'=>$request->address,
                'category_id'=>$request->category_id,
                'shop_img'=>$request->shop_img,
                'status'=>1,
                'email'=>$request->email,
            ]);
            $id = $storeinfo->id;
            ShopUser::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>1,
                'shop_store_id'=>$id,
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger','发生未知错误,添加失败!');
            return redirect()->route('home.create');
        }
        DB::commit();
        session()->flash('success','添加成功!');
        return redirect()->route('home.index');

    }
    //后台首页
    public function index(){
        $shopusers = ShopUser::all();
//        $storeInfo=StoreInfo::all();
        return view('home.index',compact('shopusers'));
    }
    //查看
    public function show(ShopUser $home){
        //店铺详情的id
        $id = $home->shop_store_id;
        $a = DB::table('store_infos')->where('id', '=',$id)->get();
        $storeinfo = $a[0];
        return view('home.show',compact('storeinfo'));
    }
    //店铺列表 用于搜索
    public function shops(Request $request){
        $infos = $request->keyword;
        if ($infos == null){//没有搜索.显示所有店铺
            $shops = StoreInfo::all();
        }else{
            $cl = new SphinxClient();
            $cl->SetServer ( '127.0.0.1', 9312);
            $cl->SetConnectTimeout ( 10 );
            $cl->SetArrayResult ( true );
            $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
            $cl->SetLimits(0, 1000);//返回1000条查询结果

            $res = $cl->Query($infos, 'shops');//第二个参数为索引 需要和配置一致
            if ($res['total']){
                $data = collect($res['matches'])->pluck('id')->toArray();
                $shops = StoreInfo::whereIn('id',$data)->get();
            }else{
                $shops = [];
            }
        }

        return view('home.shops',compact('shops'));
    }
}
