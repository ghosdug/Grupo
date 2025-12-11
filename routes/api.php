<?php

use App\Http\Controllers\Api\GruposController;
use Illuminate\Support\Facades\Route;

// Rutas de grupos usando resource. _duggud_ API
Route::apiResource('grupos', GruposController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

