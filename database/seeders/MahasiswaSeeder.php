<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::insert([
            [
                'nim' => '221011400534',
                'nama' => 'Haris Darmawan',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400535',
                'nama' => 'Farhan Ziratullah',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400536',
                'nama' => 'Muhammad Zull Syahban',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400537',
                'nama' => 'Jihan Nabilyah',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400538',
                'nama' => 'Chairul Fikri',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400539',
                'nama' => 'Muhammad Rafli',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400540',
                'nama' => 'Azhar Lubis',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400541',
                'nama' => 'Muhammad Syarif',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400542',
                'nama' => 'Shan Attar',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400543',
                'nama' => 'Malika Azhra',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '221011400544',
                'nama' => 'Maulida Azhra',
                'Jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
