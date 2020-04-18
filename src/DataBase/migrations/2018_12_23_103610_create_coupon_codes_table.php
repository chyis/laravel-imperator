<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.coupon_codes'), function (Blueprint $table) {
            $table->increments('id')->comment('优惠券id');
            $table->string('name')->comment('名称');
            $table->string('code')->unique()->comment('券码');
            $table->string('type')->comment('优惠券类型');
            $table->decimal('value')->comment('优惠额度');
            $table->unsignedInteger('total')->comment('总数');
            $table->unsignedInteger('used')->default(0)->comment('已用数量');
            $table->decimal('min_amount', 10, 2)->comment('最低使用额度');
            $table->datetime('not_before')->nullable()->comment('开始时间');
            $table->datetime('not_after')->nullable()->comment('过期时间');
            $table->boolean('enabled')->comment('是否可用');
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
        Schema::dropIfExists(config('imperator.tables.coupon_codes'));
    }
}
