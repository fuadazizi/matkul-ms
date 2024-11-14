<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\JadwalKuliah;
use App\Models\MahasiswaJadwal;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        // Read
        $listJadwal = JadwalKuliah::with([
            'dosen.matakuliah',
            'daftar_mahasiswa.mahasiswa'
        ])->get();

        $listJadwal = $listJadwal->map(function ($jadwal) {
            return [
                'id'                => $jadwal->id,
                'hari'              => $jadwal->hari,
                'jam'               => $jadwal->jam,
                'durasi'            => $jadwal->durasi,
                'ruang_kuliah'      => $jadwal->ruang_kuliah,
                'dosen_pengampu'    => $jadwal->dosen->nama,
                'matakuliah'        => $jadwal->dosen->matakuliah->nama,
                'daftar_mahasiswa'  => $jadwal->daftar_mahasiswa->map(function ($item) {
                    return $item->mahasiswa->nama;
                }),
            ];
        });

        return new PostResource(true, 'Semua data jadwal kuliah', $listJadwal);
    }

    public function show($id)
    {
        $jadwal = JadwalKuliah::with([
            'dosen.matakuliah',
            'daftar_mahasiswa.mahasiswa'
        ])->find($id);

        if ($jadwal) {
            $jadwal = [
                'id'                => $jadwal->id,
                'hari'              => $jadwal->hari,
                'jam'               => $jadwal->jam,
                'durasi'            => $jadwal->durasi,
                'ruang_kuliah'      => $jadwal->ruang_kuliah,
                'dosen_pengampu'    => $jadwal->dosen->nama,
                'matakuliah'        => $jadwal->dosen->matakuliah->nama,
                'daftar_mahasiswa'  => $jadwal->daftar_mahasiswa->map(function ($item) {
                    return $item->mahasiswa->nama;
                }),
            ];
            return new PostResource(true, 'Detail data jadwal kuliah', $jadwal);
        }
        return response()->json(['message' => 'Data jadwal kuliah tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        // Create
        $validator = Validator::make($request->all(), [
            'id_dosen'      => 'required|exists:dosen,id',
            'hari'          => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam'           => 'required|date_format:H:i:s',
            'ruang_kuliah'  => 'required|string',
            'durasi'        => 'required|integer',
            'list_mhs'      => 'required|array',
            'list_mhs.*'    => 'exists:mahasiswa,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $result = JadwalKuliah::create([
            'id_dosen'      => $request->id_dosen,
            'hari'          => $request->hari,
            'jam'           => $request->jam,
            'ruang_kuliah'  => $request->ruang_kuliah,
            'durasi'        => $request->durasi,
        ]);

        $resultMhsJadwal = [];
        foreach ($request->list_mhs as $id_mhs) {
            $resultMhsJadwal = MahasiswaJadwal::create([
                'id_jadwal'     => $result->id,
                'id_mhs'        => $id_mhs
            ]);
        }

        $resultMhsJadwal = JadwalKuliah::with([
            'dosen.matakuliah',
            'daftar_mahasiswa.mahasiswa'
        ])->find($result->id);
        if ($resultMhsJadwal) {
            $resultMhsJadwal = [
                'id'                => $resultMhsJadwal->id,
                'hari'              => $resultMhsJadwal->hari,
                'jam'               => $resultMhsJadwal->jam,
                'durasi'            => $resultMhsJadwal->durasi,
                'ruang_kuliah'      => $resultMhsJadwal->ruang_kuliah,
                'dosen_pengampu'    => $resultMhsJadwal->dosen->nama,
                'matakuliah'        => $resultMhsJadwal->dosen->matakuliah->nama,
                'daftar_mahasiswa'  => $resultMhsJadwal->daftar_mahasiswa->map(function ($item) {
                    return $item->mahasiswa->nama;
                }),
            ];
            return new PostResource(true, 'Data jadwal kuliah berhasil ditambahkan!',  [
                'jadwalkuliah' => $resultMhsJadwal
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        // Update
        $validator = Validator::make($request->all(), [
            'id_dosen'      => 'required|exists:dosen,id',
            'hari'          => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam'           => 'required|date_format:H:i:s',
            'ruang_kuliah'  => 'required|string',
            'durasi'        => 'required|integer',
            'list_mhs'      => 'required|array',
            'list_mhs.*'    => 'exists:mahasiswa,id'
        ]);

        // return count($request->list_mhs);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $jadwal = JadwalKuliah::findOrFail($id);
        if ($jadwal) {
            // $result = 
            $jadwal->update([
                'id_dosen'      => $request->id_dosen,
                'hari'          => $request->hari,
                'jam'           => $request->jam,
                'ruang_kuliah'  => $request->ruang_kuliah,
                'durasi'        => $request->durasi,
            ]);

            $listMhsjadwal = MahasiswaJadwal::where('id_jadwal', $id)->get();
            if ($listMhsjadwal->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data dengan id_jadwal tersebut tidak ditemukan',
                ], 404);
            }

            $list_mhs = $request->list_mhs;
            $maxcount = $listMhsjadwal->count() > count($list_mhs) ? $listMhsjadwal->count() : count($list_mhs);
            for ($i = 0; $i < $maxcount; $i++) {
                $mhs = $list_mhs[$i] ?? null;
                if (isset($mhs)) {
                    // selama data baru list_mhs sama panjang
                    if ($i > $listMhsjadwal->count() - 1) {
                        // jika data baru list_mhs lebih panjang, tambahkan data baru di listMhsjadwal
                        MahasiswaJadwal::create([
                            'id_jadwal'     => $id,
                            'id_mhs'        => $mhs
                        ]);
                    } else {
                        $listMhsjadwal[$i]->update([
                            'id_mhs' => $mhs
                        ]);
                    }
                } else {
                    // jika data baru list_mhs lebih pendek, hapus data di listMhsjadwal
                    MahasiswaJadwal::where('id_mhs', $listMhsjadwal[$i]->id_mhs)->delete();
                }
            }

            $resultMhsJadwal = JadwalKuliah::with([
                'dosen.matakuliah',
                'daftar_mahasiswa.mahasiswa'
            ])->find($id);
            if ($resultMhsJadwal) {
                $resultMhsJadwal = [
                    'id'                => $resultMhsJadwal->id,
                    'hari'              => $resultMhsJadwal->hari,
                    'jam'               => $resultMhsJadwal->jam,
                    'durasi'            => $resultMhsJadwal->durasi,
                    'ruang_kuliah'      => $resultMhsJadwal->ruang_kuliah,
                    'dosen_pengampu'    => $resultMhsJadwal->dosen->nama,
                    'matakuliah'        => $resultMhsJadwal->dosen->matakuliah->nama,
                    'daftar_mahasiswa'  => $resultMhsJadwal->daftar_mahasiswa->map(function ($item) {
                        return $item->mahasiswa->nama;
                    }),
                ];
                return new PostResource(true, 'Data jadwal kuliah berhasil diubah!',  [
                    'jadwalkuliah' => $resultMhsJadwal
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui data jadwal',
                ], 500);
            }
        }

        return response()->json(['message' => 'Data jadwal kuliah tidak ditemukan.'], 404);
    }

    public function destroy($id)
    {
        // Delete
        $jadwal = JadwalKuliah::find($id);
        if ($jadwal) {
            $jadwal->delete();
            return new PostResource(true, 'Data jadwal kuliah berhasil dihapus!', null);
        }

        return response()->json(['message' => 'Data jadwal kuliah tidak ditemukan'], 404);
    }
}
