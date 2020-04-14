<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_sku_id',
        'assign_date',
        'assign_time'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
