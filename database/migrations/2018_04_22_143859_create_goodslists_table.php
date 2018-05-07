<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodslistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodslists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name');//菜品名称
            $table->string('rating')->default(0);
            $table->decimal('goods_price');//价格
            $table->string('description');//描述
            $table->string('month_sales')->default(0);
            $table->string('rating_count')->default(0);
            $table->string('tips');//提示
            $table->string('satisfy_count')->default(0);
            $table->string('satisfy_rate')->default(0);
            $table->string('goods_img');//图片
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
        Schema::dropIfExists('goodslists');
    }
}
