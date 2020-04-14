<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;


class UserAddress extends Model
{
    //protected $dateFormat = 'U';
    protected $fillable = [
        'user_id',
        'province',
        'provinceid',
        'city',
        'cityid',
        'district',
        'districtid',
        'address',
        'isdefault',
        'contact_name',
        'contact_phone',
        'last_used_at',
    ];
    protected $dates = ['last_used_at'];

    // 地址所属用户
    public function user()
    {
        return $this->belongsTo('Chyis\Imperator\Models\Users', 'id', 'user_id');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->address}";
    }
}
