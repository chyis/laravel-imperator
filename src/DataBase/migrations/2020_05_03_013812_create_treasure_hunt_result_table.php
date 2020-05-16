<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreasureHuntResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.treasure_hunt_result'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hunt_id')->comment('活动编号');
            $table->string('lucky_no')->comment('幸运号码');
            $table->integer('product_id')->comment('产品编号');
            $table->integer('user_id')->comment('用户ID');
            $table->integer('buy_num')->comment('购买人次');
            $table->tinyInteger('gained')->default(0)->comment('是否获奖');
            $table->integer('buy_time')->default(0)->comment('购买时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('imperator.tables.treasure_hunt_result'));
    }
}
