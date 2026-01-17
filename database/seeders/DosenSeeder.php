<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::insert([
            [
                'nip' => 'D001',
                'nama' => 'Dr. Budi Santoso',
                'jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'D002',
                'nama' => 'Dr. Siti Aminah',
                'jurusan' => 'Sistem Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => 'D003',
                'nama' => 'Dr. Haris Darmawan',
                'jurusan' => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
