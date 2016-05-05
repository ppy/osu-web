<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class OsuAuthorizeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'osu-authorize';
    }
}
