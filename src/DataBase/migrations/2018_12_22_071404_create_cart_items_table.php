<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.cart_items'), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->unsignedInteger('sku_id')->comment('sku_id');
            $table->unsignedInteger('num')->default(1)->comment('订购数量');
			$table->timestamp('assign_at')->comment('预约时间');
			$table->string('session_id', 64)->default('')->comment('非登录用户session');
            $table->timestamp('expired_at');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('imperator.tables.cart_items'));
    }
}
