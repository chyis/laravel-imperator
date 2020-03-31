<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.roles'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique()->comment('角色名称');
            $table->string('code', 20)->comment('角色标识[开发者isxxx]');
            $table->string('icon', 100)->comment('图标或图片');
            $table->integer('min_s')->comment('预留最低积分');
            $table->integer('max_s')->comment('预留最高积分');
            $table->integer('department_id')->default(0)->comment('部门ID');
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
        Schema::dropIfExists(config('admin.tables.roles'));
    }
}
