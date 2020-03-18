<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.links'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('uri', 50)->nullable();
            $table->integer('cate_id')->default(0);
            $table->integer('sort')->default(0);
            $table->string('icon', 50)->default('');
            $table->string('description', 200)->default('');
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();

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
        Schema::dropIfExists(config('admin.tables.links'));
    }
}
