<?php

namespace SEOService2020\Morphy\Facade;

use Illuminate\Support\Facades\Facade;


class Morphy extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'morphy';
    }
}
