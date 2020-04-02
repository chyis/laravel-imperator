<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'roles';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'icon', 'min_s', 'max_s', 'department_id'];
    public $attributeNames = [
        'id'=>'编号',
        'role_name'=>'角色名称',
        'role_code'=>'角色代码',
        'department_id'=>'类型ID',
        'min_s'=>'最小积分',
        'max_s'=>'最大积分',
        'icon'=>'图标',
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

    public static function getNames()
    {
        return self::all();
    }

    function privileges()
    {
        return $this->hasOne('Chyis\Imperator\Models\RolePrivilege', 'role_id','id');
    }

    public function isRole($model)
    {
        return $this->attributes('code') == $model;
    }
}
