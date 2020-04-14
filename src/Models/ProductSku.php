<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;


class ProductSku extends Model
{
    protected $fillable = ['title', 'description', 'price', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
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
}
