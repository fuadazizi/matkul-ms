<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $fillable = ['nama', 'sks'];
    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'id_matkul');
    }
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_matkul');
    }
}
