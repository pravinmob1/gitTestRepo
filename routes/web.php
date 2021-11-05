<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PpstController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Helpers\MyStringFacad;
use Avj\Greeter\TestPackage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Cache;
use Psr\Container\ContainerInterface as psrContaier;


Route::get('/', function () {
    
    return view('welcome');
})->name('home');


Route::any('/anyTest', function () {
    return response()->json([
        "Name" => "Pravin",
        "Age" => 34,
        "Nmber" => 9821785726
    ]);
});
// Route redirect method //
Route::redirect('/testR', 'anyTest', 301);

// Route View Method //
Route::view('/laravel', 'welcome', ["name" => 'Pravin']);

// Route Parameters //
Route::get('/user/{id}/comments/{comments}', function ($id, $cmments) {
    return $id . "=" . $cmments;
});

// Regular Expression //
Route::middleware('web')->group(function () {
    Route::get('/reg/{name}/{id}', function ($name, $id) {
        return $name . "-" . $id;
    })->where(['name' => '[A-Za-z]+', 'id' => '[0-9]+']);
    // Regular Exp with common helper function //
    Route::get('/regCom/{name}/{id}', function ($name, $id) {
        return $name . "-" . $id;
    })->whereNumber('id')->whereAlphaNumeric('name')->name('regComman');
});


// Name Route //

Route::get('/name', function () {
    return 'name Route Call';
})->name('NameRoute');
Route::get('/this', function () {
    return redirect()->route('regComman', ['name' => 'Pravin', 'id' => '12456']);
});

Route::get('/testM/{name}/{id}', function ($name, $id) {
    return 'Name: ' . $name . ' and Id:' . $id;
})->middleware('testPara:SysAdmin')->withoutMiddleware('testMiddleware');
// Route Prefix method //

Route::prefix('admin')->group(function () {
    Route::get('/userAdmin', function () {
        return 'userAdmin';
    });
    Route::get('/sys/sysAdmin', function () {
        return response('TEst')->cookie('TestC', 'THis is TEst cookie');
        //return response('TEst Response',200)->header('Content-type','text/Plain');
    })->name('sysAdmin');
});
Route::fallback(function () {
    return 'HTTP Erorr 404 Page not found!';
});

// Routes with controllers //
Route::get('invCnt/{name}', [TestController::class, 'show'])->name('inv');
Route::resources([
    'posts' => PpstController::class,
    'test' => TestController::class
]);

Route::get('/post/{name}', [PostController::class, 'req']);


Route::get('/redirect', function () {

    $color = array("red", "yellow", "white");
    $x = in_array("black", $color);
    if ($x == 0)
        echo "good bye";
    if ($x == 1) echo "Hello";
    //return redirect()->away('https://www.google.com');
    //return redirect()->route('inv',['name'=>'Pravin']);
});
Route::get('/redirects/{name}', [PpstController::class, 'redirectTo']);

// Views //
Route::get('/setData/{name}', [PostController::class, 'setData'])->block($lockSeconds = 10, $waitSeconds = 20);
Route::get('/view', function (Request $request) {
    $data = ['name' => 'Pravin'];
    if (!$request->hasValidSignature()) {
        abort(401);
    }

    return view('welcome', $data);
})->name('view');

Route::get('/val/{name}/{address}', [PostController::class, 'validateReq']);

// Facades //

Route::get('/my', function () {
    //Mylab::getName();
    Mylab::getName("Test Data");
});
Route::get('/mys', [PostController::class, 'getName']);



Route::resource('user', UserController::class);

// packgae test //



Route::get('/pack/{name}',function($name){
    // Package call here//
    
    $pack = new TestPackage(); 
    return strtoupper($pack->name($name));
});
