<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
    public function index()
    {
        $listMatakuliah = Matakuliah::all();
        return new PostResource(true, 'Semua data mata kuliah', $listMatakuliah);
    }

    public function show($id)
    {
        $matakuliah = Matakuliah::find($id);
        if ($matakuliah) {
            return new PostResource(true, 'Detail data mata kuliah', $matakuliah);
        }
        return response()->json(['message' => 'Data mata kuliah tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'sks'  => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tambah data matakuliah
        $result = Matakuliah::create([
            'nama' => $request->nama,
            'sks'  => $request->sks,
        ]);
        return new PostResource(true, 'Data mata kuliah berhasil ditambahkan!', $result);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'sks'  => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $matakuliah = Matakuliah::find($id);
        if ($matakuliah) {
            $data = [
                'nama' => $request->nama,
                'sks'  => $request->sks,
            ];
            $matakuliah->update($data);
            return new PostResource(true, 'Data mata kuliah berhasil diubah!', $matakuliah);
        }

        return response()->json(['message' => 'Data mata kuliah tidak ditemukan.'], 404);
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::find($id);
        if ($matakuliah) {
            $matakuliah->delete();
            return new PostResource(true, 'Data mata kuliah berhasil dihapus!', null);
        }

        return response()->json(['message' => 'Data mata kuliah tidak ditemukan'], 404);
    }
}