<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];
    //protected $dateFormat = 'U';
    protected $fillable = [
        'title',
        'description',
        'image',
        'on_sale',
        'rating',
        'sold_count',
        'review_count',
        'price'
    ];
    public $attributeNames = [
        'id'=>'编号',
        'title'=>'产品名称',
        'cate_id'=>'分类id',
        'cate_name'=>'分类名称',
        'description'=>'简述',
        'content'=>'详细介绍',
        'image'=>'封面图',
        'org_price'=>'市价',
        'price'=>'售价',
        'created_at'=>'创建时间',
        'updated_at'=>'更新时间'
    ];
    protected $needPri = [];


    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    // 与SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function content()
    {
        return $this->hasOne('Chyis\Imperator\Models\ProductContent', 'product_id', 'id');
    }


    function getContentAttribute()
    {
        if ($this->getAttribute('id') > 0)
        {
            $content = ProductContent::where('product_id', $this->getAttribute('id'))->first();
            if ($content)
            {
                return $content->content;
            }
        }

        return '未知';
    }



    public function getExtendsAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if ($this->detail()) {
            return $this->detail()->extends;
        }
        return  '';
    }

    public function getImageUrlAttribute()
    {
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }


    /**
     * 描述:指定多个查询条件 查询多个字段 支持分页
     * @param $where
     * @param int $perPage
     * @param array $orderBy
     * @param array $columns
     * @return mixed
     * created on 2019/4/27 16:39
     * created by wangruijie
     */
    public function getAllByWhere($where, $currentPage, $perPage = 20, $orderBy = [], array $columns = ['*'])
    {
        $obj = $this->where($where);

        if (empty($orderBy) === false) {

            foreach ($orderBy as $field => $order) {
                $obj = $obj->orderBy($field, $order);
            }

        }

        return $obj->paginate($perPage, $columns, 'page', $currentPage);
    }

    /**
     * 描述:指定多个查询条件 查询多个字段 不支持分页
     * @param $where
     * @param array $orderBy
     * @param array $columns
     * @return mixed
     * created on 2019/4/27 16:55
     * created by wangruijie
     */
    public function getAllByWhereNoPaginate($where, $orderBy = [], array $columns = ['*'])
    {
        $res = $this->where($where)->select($columns);

        if (empty($orderBy) === false) {

            foreach ($orderBy as $field => $order) {
                $res = $res->orderBy($field, $order);
            }

        }

        return !empty($res->get()) ? $res->get()->toArray() : [];
    }

    /**
     * 描述: 获取一条
     * @param $where
     * @param array $orderBy
     * @param array $columns
     * @return array
     * created on 2019/5/21 18:36
     * created by wangruijie
     */
    public function getOneByWhere($where, $orderBy = [], array $columns = ['*'])
    {
        $res = $this->where($where)->select($columns);

        if (empty($orderBy) === false) {

            foreach ($orderBy as $field => $order) {
                $res = $res->orderBy($field, $order);
            }

        }

        return !empty($res->first()) ? $res->first()->toArray() : [];
    }
}
