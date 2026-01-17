<?php

namespace App\Http\Controllers;

use App\Http\Resources\Mahasiswa\MahasiswaCollection;
use App\Http\Resources\Mahasiswa\MahasiswaResource;
use App\Models\Mahasiswa;
use AuthorizesRequests;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return new MahasiswaCollection($mahasiswa);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:100'
        ]);
        $mahasiswa = Mahasiswa::create($data);
        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        // Langsung return resource
        return new MahasiswaResource($mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
{
    $data = $request->validate([
        'nim' => 'required|string|unique:mahasiswas,nim,' . $mahasiswa->id,
        'nama' => 'required|string|max:255',
        'jurusan' => 'required|string|max:100'
    ]);

    $mahasiswa->update($data);

    return new MahasiswaResource($mahasiswa);
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return response()->json([
            'message' =>
            'Deleted Successfully!'
        ], 200);
    }
}
