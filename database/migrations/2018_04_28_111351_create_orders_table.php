<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');//订单id
            $table->integer('user_id');//订单人id
            $table->string('order_code');//订单号
            $table->string('order_birth_time');//订单创建时间
            $table->string('order_status')->default(0);//订单状态
            $table->string('name');//收货人名称
            $table->string('tel');//收货人联系方式
            $table->string('provence');//省
            $table->string('city');//市
            $table->string('area');//区
            $table->string('detail_address');//详细地址
            $table->string('shop_id');//店铺id
            $table->string('shop_name');//店铺id
            $table->string('shop_img');//店铺id
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
        Schema::dropIfExists('orders');
    }
}
