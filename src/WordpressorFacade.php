<?php
namespace Apsg\Wordpressor;

use Illuminate\Support\Facades\Facade;

class WordpressorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wordpressor';
    }
}
