<?php

use App\Http\Controllers\OrderCovert;
use Illuminate\Support\Facades\Route;

Route::post('/orders', OrderCovert::class);
