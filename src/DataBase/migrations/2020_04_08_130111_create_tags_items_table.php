<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('imperator.tables.tags_items'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tag_id')->unsigned()->default(0)->comment('标签ID');
            $table->integer('item_id')->unsigned()->default(0)->comment('内容ID');
            $table->string('item_type', 10)->default('article')->comment('内容类型');

            $table->index('tag_id', 'idx_tag_id');

//            $table->foreign('tag_id')
//                ->references('id')
//                ->on('tags')
//                ->onUpdate('cascade')
//                ->onDelete('cascade');

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
        Schema::dropIfExists(config('imperator.tables.tags_items'));
    }
}
