<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.order_items'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('order_id')->comment('订单id');
            $table->unsignedInteger('product_id')->comment('产品id');
            $table->unsignedInteger('sku_id')->comment('sku_id');
            $table->decimal('price', 10, 2)->comment('价格');
            $table->unsignedInteger('rating')->nullable()->comment('评价评级');
            $table->string('review')->nullable()->comment('评价内容');
            $table->timestamp('reviewed_at')->nullable()->comment('评价时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('imperator.tables.order_items'));
    }
}
