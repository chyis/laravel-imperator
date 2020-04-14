<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.advertises'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->integer('agent_id')->default(0)->comment('广告商ID');
            $table->string('type', 10)->default('text')->comment('广告类型');
            $table->text('src')->nullable()->comment('广告代码或模板内容');
            $table->string('image', 100)->comment('图片地址');
            $table->string('url', 10)->comment('链接地址');
            $table->string('text', 100)->comment('文字');
            $table->string('size', 100)->comment('广告尺寸');
            $table->integer('start_time')->default(0)->comment('开始时间');
            $table->integer('end_time')->default(0)->comment('结束时间');

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
        Schema::dropIfExists(config('imperator.tables.advertises'));
    }
}
