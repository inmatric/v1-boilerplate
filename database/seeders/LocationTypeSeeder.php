<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LocationTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('location_type')->insert([
            [
                'location_type' => 'Ruang Kelas',
                'description' => 'Digunakan untuk kegiatan belajar mengajar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_type' => 'Laboratorium',
                'description' => 'Diperuntukkan untuk kegiatan praktikum atau eksperimen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_type' => 'Ruang Kantor',
                'description' => 'Untuk keperluan administratif pegawai dan staf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_type' => 'Aula',
                'description' => 'Ruang serbaguna untuk acara atau pertemuan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'location_type' => 'Toilet',
                'description' => 'Fasilitas umum untuk pengguna gedung',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
