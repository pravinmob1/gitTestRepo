<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $name;
     public function __construct(Request $request)
     {
         $this->name = $request->name;
         //$this->middleware('testPara:'.$this->name);
     }
    public function __invoke(Request $request)
    {
        return 'This is Invokable Contoller';
    }
    public function show(){
        echo 111;
        return url()->current();
    }

}
