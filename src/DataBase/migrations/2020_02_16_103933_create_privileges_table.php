<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.privilege'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('权限名称');
            $table->string('code', 50)->comment('权限标识[开发者使用]');
            $table->string('ext', 250)->comment('扩展标识');
            $table->integer('group_id')->default(0)->comment('权限组');
            $table->string('http_method')->nullable()->comment('请求方法');
            $table->text('http_path')->nullable()->comment('请求地址');
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
        Schema::dropIfExists(config('imperator.tables.privilege'));
    }
}
