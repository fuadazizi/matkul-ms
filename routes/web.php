<?php

use Illuminate\Support\Facades\Route;

use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\JadwalKuliah;

Route::get('/', function () {
    return view('home');
});

Route::get('mahasiswa', function () {
    $listmhs = Mahasiswa::all();
    return view("mahasiswa", compact("listmhs"));
});
Route::get('dosen', function () {
    $listdosen = Dosen::all();
    return view("dosen", compact("listdosen"));
});
Route::get('matakuliah', function () {
    $listmatakuliah = Matakuliah::all();
    return view("matakuliah", compact("listmatakuliah"));
});
Route::get('jadwalkuliah', function () {
    $listjadwal = JadwalKuliah::with([
        'dosen.matakuliah',
        'daftar_mahasiswa.mahasiswa'
    ])->get();
    return view("jadwalkuliah", compact("listjadwal"));
});