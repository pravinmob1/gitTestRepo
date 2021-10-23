<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ResponseFactory $response)
    {
        $response->macro('serialized',function($value){

        });
        View::share(['Title'=>'Title from TestSereviceProvider','Test'=>'New Title']);
        //
    }
}
