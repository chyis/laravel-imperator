<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class TagsItems extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'tags_items';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['tag_id', 'item_id', 'item_type'];
    public $attributeNames = [
        'id'=>'标签编号',
        'tag_id'=>'标签名称',
        'item_id'=>'标签拼音',
        'item_type'=>'标签类型'
    ];
    protected $needPri = [];

    //public $timestamps = false;
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    //protected $connection = 'connection-name';

//    public static function saveTags($tags, $contentID=0)
//    {
//
//    }
    public function tag()
    {
        return $this->belongsTo('/Chyis/Imperator/Models/Tags', 'id', 'tag_id');
    }
}
