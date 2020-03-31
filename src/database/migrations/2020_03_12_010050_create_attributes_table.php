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
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id')->default(0)->comment('属性类型');
            $table->string('attr_code', 20)->default('')->comment('属性标识');
            $table->enum('input_type', 'input,select,text,checkbox,radio,file')->default('input')->comment('属性值录入方式');
            $table->text('place_holder')->comment('属性默认值和备选值');
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
        Schema::dropIfExists('attributes');
    }
}
