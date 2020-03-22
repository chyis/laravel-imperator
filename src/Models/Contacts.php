<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['username', 'phone', 'content', 'type_id'];
    public $attributeNames = [
        'id'=>'编号',
        'username'=>'用户名称',
        'email'=>'邮箱',
        'phone'=>'电话',
        'content'=>'咨询内容',
        'type_id'=>'类型ID',
        'type_name'=>'类型名称',
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


    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('type_id') > 0)
        {
            $type = Dictionary::find($this->getAttribute('type_id'));
            if ($type)
            {
                return $type->var_name;
            }
        }
        return '未知';
    }

}
