@extends('layouts.app')

@section('content')
<div class="p-6 max-w-md mx-auto bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}</h1>

    <form method="POST" action="{{ isset($mahasiswa) ? route('mahasiswa.update', $mahasiswa->id) : route('mahasiswa.store') }}">
        @csrf
        @if(isset($mahasiswa))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block mb-1 font-medium">NIM</label>
            <input type="text" name="nim" value="{{ $mahasiswa->nim ?? old('nim') }}" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="nama" value="{{ $mahasiswa->nama ?? old('nama') }}" class="w-full border px-3 py-2 rounded">
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-medium">Jurusan</label>
            <input type="text" name="jurusan" value="{{ $mahasiswa->jurusan ?? old('jurusan') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            {{ isset($mahasiswa) ? 'Update' : 'Simpan' }}
        </button>
    </form>
</div>
@endsection
