<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'classification';
    protected $primaryKey = 'id';
    protected $guarded = [];
    /**
     * 可以被批量赋值的属性.
     *
     * @var array
     */
    protected $fillable = ['cate_name', 'parent_id', 'sort'];
    public $attributeNames = [
        'id'=>'编号',
        'cate_name'=>'分类名称',
        'parent_id'=>'分类父类',
        'parent_name'=>'父类名称',
        'type_id'=>'类型ID',
        'type_name'=>'类型名称',
        'sort'=>'排序',
        'image'=>'图标',
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

    function products()
    {
        return $this->hasMany(\Chyis\Imperator\Models\Product, 'cate_id', 'id');
    }

    function productCount()
    {
        return $this->attributes('id') ? Product::where('cate_id', $this->attributes('id'))->count() : 0;
    }

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

    public function getStatusNameAttribute()
    {
        if ($this->getAttribute('isDelete') == 1) return '已删除';
        if ($this->getAttribute('isDelete') == 0) return '可用';
        return '未知';
    }

    function scopeRoot($query)
    {
        return $query->where('parent_id', '0');
    }

    function scopeParent($query)
    {
        return $query->where('parent_id', 0);
    }

    public static function dirRoot()
    {
        $data = $resource = [];
        $data = self::all();
        foreach ($data  as $key=>$cate)
        {
            if ($cate->parent_id == 0)
            {
                $resource[$cate->id] = $cate;
            } else {
                $resource[$cate->parent_id]['child'][] = $cate;
            }
        }

        return $resource;
    }
}
