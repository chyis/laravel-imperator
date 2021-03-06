<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.products_sku'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('名称');
            $table->string('sku_code')->comment('sku编码[组合码]');
            $table->string('description')->comment('描述');
            $table->decimal('price', 10, 2)->comment('价格');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('storage_num')->comment('库存数');
            $table->tinyInteger('on_sale')->default(0)->comment('是否上架');
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
        Schema::dropIfExists(config('imperator.tables.products_sku'));
    }
}
