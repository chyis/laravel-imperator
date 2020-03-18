<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('admin.tables.users'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 15)->unique();
            $table->string('nick_name', 20);
            $table->string('password', 60);
            $table->string('phone', 11)->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('role_id')->default(0);
            $table->string('description',255)->default('');
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->rememberToken();
            //$table->string('remember_token', 100)->nullable();
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
        Schema::dropIfExists(config('admin.tables.users'));
    }
}
