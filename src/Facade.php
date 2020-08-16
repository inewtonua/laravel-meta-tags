<?php

namespace Inewtonua\LaravelMetaTags;

use Illuminate\Support\Facades\Facade as LFacade;

class Facade extends LFacade
{
    public static function getFacadeAccessor()
    {
        return Builder::class;
    }
}