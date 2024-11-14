<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $listdosen = Dosen::with('matakuliah')->get();
        return new PostResource(true, 'Semua data dosen', $listdosen);
    }

    public function show($id)
    {
        $dosen = Dosen::with('matakuliah')->find($id);
        if ($dosen) {
            return new PostResource(true, 'Detail data dosen', $dosen);
        }
        return response()->json(['message' => 'Data dosen tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string',
            'id_matkul' => 'required|exists:matakuliah,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Tambah data dosen
        $result = Dosen::create([
            'nama'      => $request->nama,
            'id_matkul' => $request->id_matkul,
        ]);
        return new PostResource(true, 'Data dosen berhasil ditambahkan!', $result);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string',
            'id_matkul' => 'required|exists:matakuliah,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dosen = Dosen::find($id);
        if ($dosen) {
            $data = [
                'nama'      => $request->nama,
                'id_matkul' => $request->id_matkul,
            ];
            $dosen->update($data);
            return new PostResource(true, 'Data dosen berhasil diubah!', $dosen);
        }

        return response()->json(['message' => 'Data dosen tidak ditemukan.'], 404);
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);
        if ($dosen) {
            $dosen->delete();
            return new PostResource(true, 'Data dosen berhasil dihapus!', null);
        }

        return response()->json(['message' => 'Data dosen tidak ditemukan'], 404);
    }
}