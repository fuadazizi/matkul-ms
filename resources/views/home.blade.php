@extends('layout')

@section('content')
<section class="header">
    <h1 class="">Matkul Management System ~ API</h1>
</section>
<section class="menu">
    <p style="margin-bottom: 12px;">Pilih salah satu menu</p>
    <a href="mahasiswa"> <button> Mahasiswa </button> </a>
    <a href="dosen"> <button> Dosen </button> </a>
    <a href="matakuliah"> <button> Mata Kuliah </button> </a>
    <a href="jadwalkuliah"> <button> Jadwal Mata Kuliah </button> </a>
</section>
@endsection