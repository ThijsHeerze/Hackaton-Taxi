<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReisController;
use App\Http\Controllers\RouteController;

Route::get('/reis', [ReisController::class, 'index'])->name('reis.form');

Route::post('/reis/bereken', [ReisController::class, 'bereken'])->name('reis.bereken');

Route::get('/volg-route', [RouteController::class, 'index'])->name('route.volgen');

