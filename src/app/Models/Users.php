<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['user_name', 'nick_name', 'phone', 'email', 'role_id', 'description'];
    public $attributeNames = [
        'id'=>'编号',
        'user_name'=>'用户名',
        'nick_name'=>'昵称',
        'password'=>'密码',
        'role_id'=>'角色ID',
        'role_name'=>'角色名称',
        'phone'=>'电话',
        'email'=>'邮箱',
        'description'=>'描述',
        'avatar'=>'头像',
        'status'=>'状态值',
        'status_name'=>'状态',
        'phone_verified_at'=>'电话验证时间',
        'email_verified_at'=>'邮箱验证时间',
        'deleted_at'=>'删除时间',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];
    protected $needPri = [];
    /*
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    //public $timestamps = false;
    /*
     * 模型日期列的存储格式
     *
     * @var string
     */
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    /*
     * The connection name for the models.
     *
     * @var string
     */
    //protected $connection = 'connection-name';

    public function role()
    {
        return $this->belongsTo('App/Models/Role', 'role_id', 'id');
    }

    public function privileges()
    {
        return $this->hasMany('App/Models/UserPrivilege', 'user_id', 'id');
    }
}
