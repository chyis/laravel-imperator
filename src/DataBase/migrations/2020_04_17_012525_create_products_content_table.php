<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.products_content'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_id')->comment('产品id');
            $table->text('content')->comment('产品描述内容');
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
        Schema::dropIfExists(config('imperator.tables.products_content'));
    }
}
