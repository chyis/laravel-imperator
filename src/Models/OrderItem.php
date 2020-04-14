<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'product_sku_id',
        'order_id',
        'price',
        'rating',
        'review',
        'reviewed_at'
    ];
    protected $dates = ['reviewed_at'];
    public $timestamps = false;
    // 服务信息
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    // 服务属性
    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id','id');
    }
    // 订单属性信息
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
