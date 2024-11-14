<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);
Route::apiResource('dosen', App\Http\Controllers\Api\DosenController::class);
Route::apiResource('matakuliah', App\Http\Controllers\Api\MatakuliahController::class);
Route::apiResource('jadwalkuliah', App\Http\Controllers\Api\JadwalKuliahController::class);