<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.links'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->comment('伙伴名称');
            $table->string('uri', 50)->nullable()->comment('链接地址');
            $table->integer('cate_id')->default(0)->comment('分类ID');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('icon', 50)->default('')->comment('图标或logo');
            $table->string('description', 200)->default('')->comment('说明介绍');
            $table->tinyInteger('status')->default(0)->comment('发布状态');
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
        Schema::dropIfExists(config('admin.tables.links'));
    }
}
