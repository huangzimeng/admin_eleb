<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_users', function (Blueprint $table) {
            $table->increments('id');//商家id
            $table->string('name');//商家电话
            $table->string('email');//商家邮箱
            $table->string('password');//商家密码
            $table->string('status')->default('0');//商家账号审核状态(0:审核为通过 1:审核通过)
            $table->rememberToken();
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
        Schema::dropIfExists('shop_users');
    }
}
