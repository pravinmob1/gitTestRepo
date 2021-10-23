<?php 
namespace App\Helpers;

use Illuminate\Support\Facades\Facade;


class MyStringFacad extends Facade{
    protected static function getFacadeAccessor()
    {
        return 'mylab';
    }
}
