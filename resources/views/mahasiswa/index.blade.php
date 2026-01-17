@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Mahasiswa</h1>
        <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Tambah Mahasiswa</a>
    </div>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">NIM</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Jurusan</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mahasiswas as $m)
                <tr>
                    <td class="border px-4 py-2">{{ $m->nim }}</td>
                    <td class="border px-4 py-2">{{ $m->nama }}</td>
                    <td class="border px-4 py-2">{{ $m->jurusan }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('mahasiswa.edit', $m->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
