<?php

namespace Shipu\Ebl\Facades;

use Illuminate\Support\Facades\Facade;

class Ebl extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ebl';
    }
}
