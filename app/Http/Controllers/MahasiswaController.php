<?php

namespace App\Http\Controllers;

use App\Http\Resources\Mahasiswa\MahasiswaCollection;
use App\Http\Resources\Mahasiswa\MahasiswaResource;
use App\Models\Mahasiswa;
use AuthorizesRequests;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // ===== WEB =====
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('id')->paginate(10);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return new MahasiswaResource($mahasiswa);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string',
            'jurusan' => 'required|string'
        ]);

        return new MahasiswaResource(
            Mahasiswa::create($data)
        );
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string',
            'jurusan' => 'required|string'
        ]);

        $mahasiswa->update($data);

        return new MahasiswaResource($mahasiswa);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return response()->json(['message' => 'Deleted']);
    }
}

