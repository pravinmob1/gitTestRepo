<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\MyString;

class MyStringProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('mylab',function(){
           return new MyString;
       });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
