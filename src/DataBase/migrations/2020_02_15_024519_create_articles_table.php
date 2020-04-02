<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.article'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->comment('文章标题');
            $table->string('image')->default('')->comment('封面图');
            $table->string('summary')->default('')->comment('概要');
            $table->string('tags')->default('')->comment('文章标签');
            $table->integer('cate_id')->comment('分类编号');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('comment_count')->unsigned()->default(0)->comment('评论次数');
            $table->integer('view_count')->unsigned()->default(0)->comment('浏览次数');
            $table->integer('favorite_count')->unsigned()->default(0)->comment('点赞次数');
            $table->tinyInteger('status')->comment('发布状态');

            $table->softDeletes();
            $table->timestamps();

            //$table->foreign('cate_id')
            //    ->references('id')
            //    ->on('category')
            //    ->onUpdate('cascade')
            //    ->onDelete('cascade');
        });

        Schema::create(config('imperator.tables.content'), function (Blueprint $table) {
            $table->bigIncrements('article_id');
            $table->text('content')->comment('文章内容');
            $table->text('extends')->comment('扩展属性');
            $table->integer('create_user')->default(0)->comment('创建人');
            $table->integer('last_modify_user')->default(0)->comment('最后修改人');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('imperator.tables.article'));
        Schema::dropIfExists(config('imperator.tables.content'));
    }
}
