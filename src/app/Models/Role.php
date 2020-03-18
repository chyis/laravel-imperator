<?php

namespace App\Models;

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
    protected $fillable = ['name', 'icon', 'department_id'];
    public $attributeNames = [
        'id'=>'编号',
        'name'=>'分类名称',
        'parent_id'=>'分类父类',
        'parent_name'=>'父类名称',
        'type_id'=>'类型ID',
        'type_name'=>'类型名称',
        'sort'=>'排序',
        'hot'=>'热度',
        'icon'=>'图标',
        'create_uid'=>'创建人ID',
        'create_username'=>'创建人',
        'is_delete'=>'删除与否',
        'status_name'=>'状态',
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

    public static function getNames()
    {
        return self::all()->pluck('id', 'name');
    }

    function privileges()
    {
        return $this->hasOne('App\Models\RolePrivilege', 'role_id','id');
    }

}
