<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');//订单id
            $table->integer('order_id');//订单id
            $table->integer('goods_id');//商品id
            $table->string('goods_name');//商品名称
            $table->string('goods_img');//商品图片
            $table->string('amount');//商品数量
            $table->string('goods_price');//商品价格
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
        Schema::dropIfExists('order_goods');
    }
}
