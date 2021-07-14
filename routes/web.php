<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'dashboard.', 'middleware' => ['auth']], function () {
    Route::get('/', 'App\Http\Controllers\Dashboard\DashboardController@index')->name('index');
});

Route::group(['as' => 'entries.', 'prefix' => 'entries', 'middlware' => ['auth']], function () {
    Route::get('/current', 'App\Http\Controllers\Entries\Ajax\EntryController@current')->name('current');
    Route::post('/store', 'App\Http\Controllers\Entries\Ajax\EntryController@store')->name('store');
    Route::put('/{id}/update', 'App\Http\Controllers\Entries\Ajax\EntryController@update')->name('update');
});