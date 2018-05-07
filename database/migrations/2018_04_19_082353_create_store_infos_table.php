<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_infos', function (Blueprint $table) {
            $table->increments('id');//商家详细信息
            $table->string('shop_name')->default('');//商家店铺名称
            $table->string('shop_img')->default('');//店铺logo
            $table->string('address')->default('');//店铺地址
            $table->string('category_id')->default(0);//分类id
            $table->string('service_code')->default(0);//店铺的服务总评分
            $table->string('foods_code')->default(0);//店铺食物总评分
            $table->string('high_or_low')->default('');//低于还是高于周边商家
            $table->string('h_l_percent')->default('');//低于还是高于周边商家的百分比
            $table->tinyInteger('brand')->default(0);//是否是品牌(0:不是 1:是)
            $table->tinyInteger('on_time')->default(0);//是否准时达(0:不是 1:是)
            $table->tinyInteger('fengniao')->default(0);//是否是蜂鸟配送
            $table->tinyInteger('bao')->default(0);//是否保标记
            $table->tinyInteger('piao')->default(0);//是否票标记
            $table->tinyInteger('zhun')->default(0);//是否准标记
            $table->string('start_send')->default(0);//起送金额
            $table->string('send_cost')->default(0);//配送费
            $table->string('estimate_time')->default(0);//预计时间
            $table->string('notice')->default('');//店铺公告
            $table->string('discount')->default('');//优惠信息
            $table->string('email');//邮箱
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_infos');
    }
}
