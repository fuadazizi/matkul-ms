<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    
    protected $table = 'mahasiswa';
    protected $fillable = ['nama', 'jurusan', 'angkatan'];
    
    public function mahasiswaJadwal()
    {
        return $this->hasMany(MahasiswaJadwal::class, 'id_mhs');
    }
}
