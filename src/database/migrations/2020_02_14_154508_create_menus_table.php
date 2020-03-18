<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.menu'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('uri', 50)->nullable();
            $table->integer('type_id')->default(0);
            $table->string('type', 10)->default('admin');
            $table->string('position', 10)->default('');
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('icon', 50)->default('');
            $table->integer('privilege_id')->default(0);
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
        Schema::dropIfExists(config('admin.tables.menu'));
    }
}
