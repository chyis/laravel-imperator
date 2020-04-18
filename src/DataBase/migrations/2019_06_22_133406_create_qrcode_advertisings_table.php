<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrcodeAdvertisingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.qrcode_advertisings'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->default(0)->comment('第三方id');
            $table->integer('invitor_id')->default(0)->comment('邀请人id');
            $table->integer('uid')->default(0)->comment('被邀请人id');

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
        Schema::dropIfExists(config('imperator.tables.qrcode_advertisings'));
    }
}
