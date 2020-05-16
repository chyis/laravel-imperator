<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreasureHuntTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.treasure_hunt'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('活动标题');
            $table->string('sub_title')->comment('附标题');
            $table->string('release_no')->comment('期次');
            $table->integer('product_id')->default(0)->comment('产品编号');
            $table->integer('gain_user_id')->default(0)->comment('获奖人编号');
            $table->integer('need_num')->default(0)->comment('本期总人次');
            $table->integer('current_num')->default(0)->comment('当前总人次');
            $table->integer('start_time')->default(0)->comment('开始时间');
            $table->integer('end_time')->default(0)->comment('开奖时间');
            $table->integer('create_uid')->default(0)->comment('创建人');
            $table->tinyInteger('gained')->default(0)->comment('是否获奖');
            $table->softDeletes();
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
        Schema::dropIfExists(config('imperator.tables.treasure_hunt'));
    }
}
