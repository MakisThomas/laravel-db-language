<?php 

namespace Makth\DbLanguage\Facade;

use Illuminate\Support\Facades\Facade;


class Lang extends Facade {
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lang'; // the IoC binding.
    }
}