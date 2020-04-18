<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.products'), function (Blueprint $table) {
            $table->increments('id')->comment('产品id');
            $table->string('title')->comment('产品名称');
            $table->text('description')->comment('产品内容');
            $table->string('image')->comment('主图');
            $table->integer('cate_id')->default(0)->comment('分类');
            $table->integer('on_sale')->default(0)->comment('上架时间');
            $table->float('rating')->default(5)->comment('等级[没用]');
            $table->unsignedInteger('sold_count')->default(0)->comment('售出总数');
            $table->unsignedInteger('review_count')->default(0)->comment('获得评价总数');
            $table->unsignedInteger('view_count')->default(0)->comment('浏览总数');
            $table->decimal('price', 10, 2)->comment('售价');
            $table->decimal('org_price', 10, 2)->default(0.00)->comment('原价');
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
        Schema::dropIfExists(config('imperator.tables.products'));
    }
}
