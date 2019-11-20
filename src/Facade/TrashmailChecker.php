<?php

namespace TobiSchulz\TrashmailChecker\Facade;

use Illuminate\Support\Facades\Facade;

class TrashmailChecker extends Facade
{
    /**
     * The trashmail facade accessor.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'trashmailchecker';
    }
}
