<?php

namespace Chyis\Imperator\Facades;

use Illuminate\Support\Facades\Facade;

class Imperator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'imperator';
    }
}