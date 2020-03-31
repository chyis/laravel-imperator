<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePrivilegeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.role_pri'), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('role_id')->comment('角色ID');
            $table->integer('pri_id')->comment('权限ID');
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('admin.tables.role_pri'));
    }
}
