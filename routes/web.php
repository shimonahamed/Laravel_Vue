<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'doLogin']);


Route::view('admin/{any}', 'singleApp')->where('any', '.*')->middleware('auth');


Route::prefix('api')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    Route::post('/required_data', [\App\Http\Controllers\SupportController::class, 'requireData']);
    Route::get('/configurations', [\App\Http\Controllers\SupportController::class, 'getconfigurations']);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('subcategories', \App\Http\Controllers\SubCategoryController::class);

});
