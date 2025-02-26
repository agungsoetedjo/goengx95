<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;

Route::get('/tugas', [TugasController::class, 'index']);
Route::get('/tugas/data', [TugasController::class, 'getData']);
Route::post('/tugas/store', [TugasController::class, 'store']);
Route::get('/tugas/edit/{id}', [TugasController::class, 'edit']);
Route::post('/tugas/update/{id}', [TugasController::class, 'update']);
Route::delete('/tugas/destroy/{id}', [TugasController::class, 'destroy']);
