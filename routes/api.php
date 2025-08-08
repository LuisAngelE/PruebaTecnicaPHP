<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CarpetaController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\TipoArchivoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('empresas', EmpresaController::class);
Route::apiResource('direcciones', DireccionController::class);
Route::apiResource('areas', AreaController::class);
Route::apiResource('carpetas', CarpetaController::class);
Route::apiResource('documentos', DocumentoController::class);
Route::apiResource('tipos-archivos', TipoArchivoController::class);

