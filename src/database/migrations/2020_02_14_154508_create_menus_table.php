<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.menu'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment('菜单标题');
            $table->string('uri', 50)->nullable()->comment('菜单地址');
            $table->integer('type_id')->default(0)->comment('菜单类型ID');
            $table->string('type', 10)->default('admin')->comment('类型标识');
            $table->string('position', 10)->default('')->comment('位置标识');
            $table->integer('parent_id')->default(0)->comment('上级菜单');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('icon', 50)->default('')->comment('图标或图片');
            $table->integer('privilege_id')->default(0)->comment('所属权限');
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
        Schema::dropIfExists(config('admin.tables.menu'));
    }
}
