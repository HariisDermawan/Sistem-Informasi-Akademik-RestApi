<?php

namespace App\Http\Controllers;

use App\Http\Resources\Dosen\DosenCollection;
use App\Http\Resources\Dosen\DosenResource;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();
        return new DosenCollection($dosen);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|string|unique:dosens,nip',
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:100',
        ]);

        $dosen = Dosen::create($data);
        return new DosenResource($dosen);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return new DosenResource($dosen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'nip'       => 'required|string|unique:dosens,nip,' . $dosen->id,
            'nama'      => 'required|string|max:255',
            'jurusan'   => 'required|string|max:100'
        ]);

        $dosen->update($data);
        return new DosenResource($dosen);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        return response()->json(['message' => 'Deleted Successfully!'], 200);
    }
}
