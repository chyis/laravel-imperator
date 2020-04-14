<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no')->unique()->comment('订单号');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->text('address')->comment('地址');
            $table->decimal('total_amount', 10, 2)->comment('总金额');
            $table->text('remark')->nullable()->comment('客户备注');
            $table->unsignedInteger('coupon_code_id')->nullable()->comment('用户使用优惠券');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_method')->nullable()->comment('支付方式');
            $table->string('payment_no')->nullable()->comment('第三方支付流水号');
            $table->string('refund_status')->default(\App\Models\Order::REFUND_STATUS_PENDING)->comment('退款状态');
            $table->string('refund_no')->unique()->nullable()->comment('退款流水单号');
            $table->boolean('closed')->default(false)->comment('关闭此单');
            $table->boolean('reviewed')->default(false)->comment('此单已经评论了');
            $table->string('ship_status')->default(\App\Models\Order::SHIP_STATUS_PENDING)->comment('配送[服务]状态');
            $table->text('ship_data')->nullable()->comment('服务其它信息');
            $table->text('extra')->nullable()->comment('订单其它信息[居室/平米/其它...]');
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
        Schema::dropIfExists('orders');
    }
}
