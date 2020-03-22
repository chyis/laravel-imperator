<?php

namespace Chyis\Imperator;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $table = 'users';

    protected $fillable = [
        'user_name', 'password',
    ];

    protected $hidden = [
        //remember_token 字段用于记住我的功能
        'password', 'remember_token',
    ];

    public static $rules = [
        'user_name'=>'required',
        'password'=>'required'
    ];

}
