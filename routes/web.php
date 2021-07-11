<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['as' => 'dashboard.', 'middleware' => ['auth']], function () {
    Route::get('/', 'App\Http\Controllers\Dashboard\DashboardController@index')->name('index');
});