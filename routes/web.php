<?php

use Illuminate\Support\Facades\Route;

Route::view('admin/{any}', 'singleApp')->where('any', '.*');
Route::prefix('api')->group(function () {
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('subcategories', \App\Http\Controllers\SubCategoryController::class);
});
