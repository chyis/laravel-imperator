<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.contacts'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->comment('咨询者用户名');
            $table->string('email', 30)->comment('咨询者邮箱');
            $table->string('phone', 15)->comment('咨询者博客地址');
            $table->integer('type_id')->default(0)->comment('咨询类型');
            $table->text('content')->comment('咨询内容');
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
        Schema::dropIfExists(config('imperator.tables.contacts'));
    }
}
