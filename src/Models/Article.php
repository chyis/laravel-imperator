<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Article extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article';

    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'cate_id', 'summary'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'标题',
        'summary'=>'描述',
        'cate_id'=>'栏目',
        'cate_name'=>'栏目名称',
        'type_name'=>'类型名称',
        'create_uid'=>'创建人ID',
        'create_username'=>'创建人',
        'last_uid'=>'修改人人ID',
        'last_username'=>'修改人',
        'tags'=>'标签',
        'content'=>'内容',
        'extends'=>'扩展内容',
        'sort'=>'权重',
        'comment_count'=>'删除与否',
        'view_count'=>'删除与否',
        'favorite_count'=>'删除与否',
        'status_name'=>'状态',
        'deleted_at'=>'删除时间',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];
    protected $needPri = [];

    //public $timestamps = false;
    //protected $dateFormat = 'U';
    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';
    //protected $connection = 'connection-name';


    function category()
    {
        return $this->hasOne('Chyis\Imperator\Models\Category', 'id','cate_id');
    }

    public static function top($type, $num=10)
    {
        $orderField = $type . "_count";
        return self::
//            ->where()
            orderBy("$orderField", "DESC")
            ->take($num);
    }

    public static function random()
    {
        return self::
//            ->where()
            orderBy("id", "DESC")
            ->take(10)
            ->get();
    }

    public static function latest($num=10)
    {
        return self::
//            ->where()
            orderBy("created_at", "DESC")
            ->take($num)
            ->get();
    }

    function content()
    {
        return $this->hasOne('Chyis\Imperator\Models\ArticleContent', 'id','cate_id');
    }

    function getContentAttribute()
    {
        if ($this->getAttribute('id') > 0)
        {
            $content = ArticleContent::find($this->getAttribute('id'));
            if ($content)
            {
                return $content->content;
            }
        }

        return '未知';
    }


    function getCreatedDateAttribute()
    {
        if ($this->getAttribute('created_at') != '')
        {
            $time = explode(' ', $this->getAttribute('created_at'));

            return $time[0];
        }
        return '未知';
    }
}
