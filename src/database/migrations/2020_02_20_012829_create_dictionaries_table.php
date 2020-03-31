<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.dictionary'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('var_name', 50)->unique()->comment('字典名称');
            $table->string('var_code', 30)->comment('字典标识');
            $table->string('var_value', 100)->comment('字典值');
            $table->tinyInteger('type')->default(0)->comment('字典类型');//0系统级别1自定义
            $table->integer('parent_id')->comment('上级字典');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('create_uid')->comment('创建者ID');
            $table->integer('last_uid')->comment('最后更新者ID');
            $table->tinyInteger('is_delete')->default(0)->comment('是否删除');
            $table->index('parent_id');
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
        Schema::dropIfExists(config('admin.tables.dictionary'));
    }
}
