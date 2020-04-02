<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.attachment'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name')->comment('上传文件名');
            $table->string('file_url')->comment('文件地址');
            $table->string('description')->default('')->comment('文件说明');
            $table->string('tags')->default('')->comment('标签');
            $table->integer('size')->comment('文件大小');
            $table->string('ext')->default('')->comment('扩展名');
            $table->integer('article_id')->comment('所属内容ID');
            $table->integer('cate_id')->comment('分类');
            $table->integer('ref_count')->comment('引用次数');
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
        Schema::dropIfExists(config('imperator.tables.attachment'));
    }
}
