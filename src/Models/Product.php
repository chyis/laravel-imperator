<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
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
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];
    // 与服务SKU关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
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
