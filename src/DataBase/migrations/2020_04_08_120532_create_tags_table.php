<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.tags'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50);
            $table->string('pinyin', 50)->default('')->comment('标签拼音');
            $table->string('type', 10)->comment('标签类型');
            $table->text('content')->comment('特殊标签会有解释内容');
            $table->integer('views')->default(0)->comment('热度');

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
        Schema::dropIfExists(config('imperator.tables.tags'));
    }
}
