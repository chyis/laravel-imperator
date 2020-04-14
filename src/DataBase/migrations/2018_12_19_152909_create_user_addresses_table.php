<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('城市');
            $table->string('district')->comment('地区');
            $table->integer('provinceid')->comment('省份id');
            $table->integer('cityid')->comment('城市id');
            $table->integer('districtid')->comment('地区id');
            $table->string('address')->comment('地址详情');
            $table->string('contact_name')->comment('联系人名称');
            $table->string('contact_phone')->comment('联系电话');
            $table->tinyInteger('isdefault')->default(0)->comment('默认地址');
            $table->dateTime('last_used_at')->nullable()->comment('最后使用此地址时间');
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
        Schema::dropIfExists('user_addresses');
    }
}
