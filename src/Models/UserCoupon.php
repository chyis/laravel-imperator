<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class UserCoupon extends Model
{
    //protected $dateFormat = 'U';
    protected $fillable = [
        'coupon_id',
        'code',
        'user_id',
        'used',
        'last_used_at',
    ];
    protected $dates = ['last_used_at'];

    // 所属用户关联关系
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->withDefault(function (){
            return ['id'=>0, 'name'=>'未注册用户', 'email'=>'@' , 'phone'=>'', 'password'=>''];
        });
    }
    // 所属的类别
    public function coupon()
    {
        return $this->belongsTo('App\Models\CouponCode', 'coupon_id', 'id')->withDefault(function (){
            return ['id'=>0, 'name'=>'未知卡券', 'type'=>'*' , 'value'=>'*', 'total'=>'*'];
        });
    }
}
