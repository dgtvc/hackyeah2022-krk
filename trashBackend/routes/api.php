<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('location', \App\Http\Controllers\FetchLocationAction::class)
    ->name('location.fetch');

Route::post('location', \App\Http\Controllers\StoreLocationAction::class)
    ->name('location.store');

Route::get('category', \App\Http\Controllers\FetchCategoryAction::class)
    ->name('category.fetch');

Route::get('ok', fn () => 'ok');
