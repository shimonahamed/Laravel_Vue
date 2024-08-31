<?php

use Illuminate\Support\Facades\Route;

Route::view('admin/{any}', 'singleApp')->where('any', '.*');

