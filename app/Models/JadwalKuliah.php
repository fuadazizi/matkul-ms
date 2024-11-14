<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKuliah extends Model
{
    use HasFactory;

    protected $table = 'jadwalkuliah';
    protected $fillable = ['hari', 'jam', 'ruang_kuliah', 'durasi', 'id_dosen'];
    
    public function daftar_mahasiswa()
    {
        return $this->hasMany(MahasiswaJadwal::class, 'id_jadwal');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
