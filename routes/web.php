<?php

use App\Http\Controllers\ProductController;
use App\Livewire\ProductIndex;
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

Route::get('/admin/products', ProductIndex::class)->name('admin.products.index');

// (new RouteBuilder('nav-admin'))->create();
