<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileApiController;


Route::post('/checkin','MobileApiController@checkin');

Route::post('/checkout','MobileApiController@checkout');
