<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AlumnoController;
use App\Http\Controllers\AlumnoMongoController;

// Rutas para controlador AlumnoController
Route::apiResource('alumnos', AlumnoController::class);

// Rutas para controlador AlumnoMongoController
Route::apiResource('alumnos-mongo', AlumnoMongoController::class);
