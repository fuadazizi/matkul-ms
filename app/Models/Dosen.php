<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    
    protected $table = 'dosen';
    protected $fillable = ['nama', 'id_matkul'];
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matkul');
    }
    public function jadwalKuliah()
    {
        return $this->hasMany(JadwalKuliah::class, 'id_dosen');
    }
}
