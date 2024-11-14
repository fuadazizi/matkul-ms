<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index() {
        $listmhs = Mahasiswa::all();
        return new PostResource(true, 'Semua data mahasiswa', $listmhs);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            return new PostResource(true, 'Detail data mahasiswa', $mahasiswa);
        }
        return response()->json(['message' => 'Data mahasiswa tidak ditemukan.'], 404);
    }

    public function store(Request $request)
    {
        // Create
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'jurusan'       => 'required',
            'angkatan'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $result = Mahasiswa::create([
            'nama'          => $request->nama,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan
        ]);
        return new PostResource(true, 'Data mahasiswa berhasil ditambahkan!', $result);
    }

    public function update(Request $request, $id)
    {
        // Update
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'jurusan'       => 'required',
            'angkatan'      => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            $data = array(
                'nama'      => $request->nama,
                'jurusan'   => $request->jurusan,
                'angkatan'  => $request->angkatan
            );
            $mahasiswa->update($data);
            return new PostResource(true, 'Data mahasiswa berhasil diubah!', $mahasiswa);
        }

        return response()->json(['message' => 'Data mahasiswa tidak ditemukan.'], 404);
    }

    public function destroy($id)
    {
        // Delete
        $mahasiswa = Mahasiswa::find($id);
        if ($mahasiswa) {
            $mahasiswa->delete();
            return new PostResource(true, 'Data mahasiswa berhasil dihapus!', null);
        }

        return response()->json(['message' => 'Data mahasiswa tidak ditemukan'], 404);
    }
}