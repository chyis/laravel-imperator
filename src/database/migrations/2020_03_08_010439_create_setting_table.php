<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.setting'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->integer('group_id')->default(0)->comment('分组');
            $table->string('type', 10)->default('admin')->comment('配置类型');
            $table->string('code', 10)->nullable()->comment('配置代码');
            $table->string('default_value', 10)->comment('默认');
            $table->text('value_text')->comment('配置值');
            $table->integer('order')->default(0)->comment('排序');
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
        Schema::dropIfExists(config('admin.tables.setting'));
    }
}
