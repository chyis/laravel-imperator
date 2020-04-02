<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.category'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cate_name')->comment('分类名称');
            $table->integer('parent_id')->default(0)->comment('父级分类');
            $table->integer('type_id')->default(0)->comment('栏目类型');
            $table->integer('sort')->default(0)->comment('固定排序');
            $table->integer('hot')->default(0)->comment('分类热度');
            $table->string('image')->default('')->comment('分类图片');
            $table->integer('create_uid')->default(0)->comment('创建人');
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
        Schema::dropIfExists(config('imperator.tables.category'));
    }
}
