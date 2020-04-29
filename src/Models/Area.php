<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'area_name',
        'level',
        'parent_id'
    ];
    public $attributeNames = [
        'id'=>'编号',
        'area_name'=>'标题',
        'level'=>'级别',
        'parent_id'=>'上级'
    ];
    protected $needPri = [];

}
