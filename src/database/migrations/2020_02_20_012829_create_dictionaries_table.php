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
            $table->string('var_name', 50)->unique();
            $table->string('var_code', 30);
            $table->string('var_value', 100);
            $table->tinyInteger('type')->default(0);//0系统级别1自定义
            $table->integer('parent_id');
            $table->integer('sort')->default(0);
            $table->integer('create_uid');
            $table->integer('last_uid');
            $table->tinyInteger('is_delete')->default(0);
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
