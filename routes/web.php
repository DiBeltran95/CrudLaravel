<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('departamentos', DepartamentoController::class);
    Route::post('departamentos/buscar', [DepartamentoController::class, 'buscar']);

    Route::resource('empleados', EmpleadoController::class);
    Route::post('empleados/buscar', [EmpleadoController::class, 'buscar']);
});
