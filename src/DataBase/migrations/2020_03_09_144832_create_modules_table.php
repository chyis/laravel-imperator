<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.modules'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->string('code', 20)->default('')->comment('模块标识');
            $table->integer('page_id')->default(0)->comment('页面ID');
            $table->string('page_code', 20)->default('')->comment('页面标识');
            $table->string('type', 10)->default('advertise')->comment('模块内容类型');
            $table->text('content')->nullable()->comment('代码或者单独类型ID值');
            $table->integer('length')->default(0)->comment('默认内容条数');

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
        Schema::dropIfExists(config('imperator.tables.modules'));
    }
}
