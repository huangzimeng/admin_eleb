<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodscategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goodscategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');//描述
            $table->boolean('is_select');//是否选中
            $table->string('name');//分类名称
            $table->string('type_accumulation')->default('');//c1
            $table->integer('store_id');//分类对应店铺的id
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
        Schema::dropIfExists('goodscategories');
    }
}
