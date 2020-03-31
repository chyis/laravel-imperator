<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'attachment';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['file_name', 'file_url', 'description', 'tags', 'size', 'ext', 'article_id', 'cate_id', 'ref_count'];
    public $attributeNames = [
        'id'=>'编号',
        'file_name'=>'上传文件名',
        'file_url'=>'文件地址',
        'description'=>'文件说明',
        'tags'=>'标签',
        'size'=>'文件大小',
        'ext'=>'文件扩展名',
        'article_id'=>'文章ID',
        'cate_id'=>'分类ID',
        'ref_count'=>'引用数量',
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
}
