<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.attributes'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id')->default(0)->comment('属性类型ID');
            $table->string('attr_name', 20)->default('')->comment('属性名称');
            $table->string('attr_code', 20)->default('')->comment('属性标识');
            $table->string('input_type', 20)->default('input')->comment('内容录入方式');
            $table->string('validate', 100)->default('input')->comment('内容验证方式');
            $table->enum('data_source', ['input', 'model', 'assign'])->default('input')->comment('数据来源');
            $table->text('place_holder')->comment('属性默认值及备选值');
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
        Schema::dropIfExists(config('imperator.tables.attributes'));
    }
}
