<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enents', function (Blueprint $table) {
            $table->increments('id');//抽奖活动id
            $table->string('title')->comment('标题');
            $table->string('contents')->comment('活动标题');
            $table->string('signup_start')->comment('开始报名时间');
            $table->string('signup_end')->comment('结束报名时间');
            $table->string('prize_date')->comment('开奖日期');
            $table->integer('signup_num')->comment('报名人数限制');
            $table->integer('is_prize')->default(0)->comment('是否开奖');
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
        Schema::dropIfExists('enents');
    }
}
