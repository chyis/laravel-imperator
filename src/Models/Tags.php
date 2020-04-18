<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Chyis\Imperator\Models\TagsItems;

class Tags extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'tags';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'pinyin', 'type', 'content'];
    public $attributeNames = [
        'id'=>'标签编号',
        'title'=>'标签名称',
        'pinyin'=>'标签拼音',
        'type'=>'标签类型',
        'content'=>'标签说明内容',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间',
    ];
    protected $needPri = [];

    //public $timestamps = false;
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    //protected $connection = 'connection-name';

    public static function top($type='manual', $num=12)
    {
        return self::
            where('type', $type)
            ->orderBy('views', 'DESC')
            ->take($num)
            ->get();
    }

    public function saveTags($tags, $contentID = 0, $type = 'article')
    {
        foreach ($tags as $key=>$tag)
        {
            $this->saveTag($tag, $contentID, $type);
        }
    }

    public function saveTag($tag, $contentID, $type)
    {
        $existTag = $this->firstOrNew(['title'=>$tag], ['pinyin'=>'', 'type'=>'manual', 'content'=>'']);
        $existTag->save();

        $items = new TagsItems();
        $item = $items->where(['tag_id'=>$existTag->id])
            ->where(['item_id'=>$contentID])
            ->first();
        if (!isset($item)) {
            $items->create(['tag_id'=>$existTag->id, 'item_id'=>$contentID, 'item_type'=>$type]);
        }
    }

    public function items()
    {
        return $this->hasMany('Chyis\Imperator\Models\TagsItems', 'tag_id', 'id');
    }
}
