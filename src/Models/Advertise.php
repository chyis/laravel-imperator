<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'advertises';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'src', 'image', 'url', 'text', 'size', 'start_time', 'end_time'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'名称',
        'type'=>'类型',
        'src'=>'代码',
        'url'=>'链接',
        'text'=>'内容',
        'size'=>'尺寸',
        'create_uid'=>'创建人ID',
        'create_username'=>'创建人',
        'start_time'=>'开始时间',
        'end_time'=>'结束时间',
        'status_name'=>'状态',
        'deleted_at'=>'删除时间',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];
    protected $needPri = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    //public $timestamps = false;
    /**
     * 模型日期列的存储格式
     *
     * @var string
     */
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    //protected $connection = 'connection-name';

    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('type') == 'image') return '图片广告';
        if ($this->getAttribute('type') == 'text') return '文字广告';
        if ($this->getAttribute('type') == 'src') return '代码广告';
        if ($this->getAttribute('type') == 'temp') return '模板广告';
        return '未定义';
    }

}
