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
            $table->string('user_name', 15)->unique()->comment('用户名');
            $table->string('nick_name', 20)->comment('昵称');
            $table->string('password', 60)->comment('密码');
            $table->string('phone', 11)->unique()->comment('手机号');
            $table->timestamp('phone_verified_at')->nullable()->comment('手机号验证时间');
            $table->string('email')->unique()->comment('邮箱地址');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->string('avatar')->nullable()->comment('头像');
            $table->integer('role_id')->default(0)->comment('角色ID');
            $table->string('description',255)->default('')->comment('说明解释');
            $table->tinyInteger('status')->default(0)->comment('发布状态');
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
