<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            /**
             * name: 收货人
             * tel: 联系方式
             * provence: 省
             * city: 市
             * area: 区
             * detail_address: 详细地址
             */
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('tel');
            $table->string('provence');
            $table->string('city');
            $table->string('area');
            $table->string('detail_address');
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
        Schema::dropIfExists('addresses');
    }
}
