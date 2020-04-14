<?php

namespace Chyis\Imperator\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id',
        'areaname',
        'level',
        'parentid'
    ];
}
