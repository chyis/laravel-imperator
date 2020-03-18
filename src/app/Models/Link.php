<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dictionary;
use App\Models\Users;

class Link extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'links';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['title', 'uri', 'cate_id', 'sort', 'icon', 'description'];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'伙伴名称',
        'uri'=>'链接地址',
        'cate_id'=>'伙伴类型',
        'cate_name'=>'类型名称',
        'description'=>'简介',
        'icon'=>'图标',
        'sort'=>'排序',
//        'create_uid'=>'创建人ID',
//        'create_username'=>'创建人',
        'status'=>'状态值',
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


    public function getStatusNameAttribute()
    {
        if ($this->getAttribute('deleted_at') != '') return '已删除';
        return '可用';
    }


    public function getTypeNameAttribute()
    {
        if ($this->getAttribute('cate_id') > 0)
        {
            $cate_id = $this->getAttribute('cate_id');
            $dict = Dictionary::find($cate_id);
            if ($dict)
            {
                return $dict->var_name;
            }
        }

        return null;
    }

    public function getCreateUserAttribute()
    {
        $create_uid = $this->getAttribute('create_uid');
        $creatUser = Users::find($create_uid);
        if ($creatUser)
        {
            return $creatUser;
        }

        return null;
    }

}
