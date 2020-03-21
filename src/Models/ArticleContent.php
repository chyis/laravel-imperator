<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'article_content';
    protected $primaryKey = 'article_id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['article_id', 'content', 'create_user', 'last_modify_user'];
    public $attributeNames = [
        'article_id'=>'编号',
        'create_user'=>'创建人ID',
        'create_username'=>'创建人',
        'last_modify_user'=>'修改人人ID',
        'last_modify_username'=>'修改人',
        'content'=>'内容',
        'extends'=>'扩展内容'
    ];
    protected $needPri = [];
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
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
