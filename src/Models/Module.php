<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'page_id', 'page_code', 'content', 'length'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'名称',
        'type'=>'类型',
        'page_id'=>'页面ID',
        'page_code'=>'页面代码',
        'content'=>'内容',
        'length'=>'尺寸',
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

    public function page()
    {
        $pageID = $this->getAttribute('page_id');

        return Dictionary::find($pageID);
//        return $this->belongsTo('\Models\Dictionary', 'page_id', 'id');
    }

    public function getSourceTypeAttribute()
    {
        $type = $this->getAttribute('type');

        return in_array($type, ['hot-news', 'hot-news', 'fast-news', 'top-goods', 'new-goods', 'top-service']);
    }


    public function getManualTypeAttribute()
    {
        $type = $this->getAttribute('type');

        return !in_array($type, ['hot-news', 'hot-news', 'fast-news', 'top-goods', 'new-goods', 'top-service']);
    }
}
