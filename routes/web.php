<?php

use Illuminate\Support\Facades\Route;
use Naykel\Gotime\RouteBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('pages.home', ['title' => 'Welcome']);
})->name('home');

(new RouteBuilder('nav-main'))->create();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

// (new RouteBuilder('nav-admin'))->create();

Route::prefix('admin/widgets')->name('admin.widgets')->group(function () {
    Route::livewire('/', 'admin::widget.index')->name('.index');
    Route::livewire('/create', 'admin::widget.form')->name('.create');
    Route::livewire('/{widget}/edit', 'admin::widget.form')->name('.edit');
});
