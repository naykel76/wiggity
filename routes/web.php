<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Naykel\Gotime\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

(new RouteBuilder('nav-main'))->create();

Route::resource('products', ProductController::class);
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

// (new RouteBuilder('nav-admin'))->create();
