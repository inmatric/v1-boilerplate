<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class LocationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'id' => 1,
                'company_id' => 1,
                'company' => 'PT. Alpha Outsourcing',
                'location' => 'Gedung A - Lantai 1',
                'location_type' => 'Ruang Kerja',
                'location_code' => 'RK01',
                'information' => 'Ruang kerja utama untuk staf administrasi',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'company_id' => 1,
                'company' => 'PT. Alpha Outsourcing',
                'location' => 'Gudang Utama',
                'location_type' => 'Gudang',
                'location_code' => 'RK02',
                'information' => 'Penyimpanan barang inventaris kantor',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'company_id' => 1,
                'company' => 'PT. Alpha Outsourcing',
                'location' => 'Gudang Utama',
                'location_type' => 'Gudang',
                'location_code' => 'GD01',
                'information' => 'Penyimpanan barang inventaris kantor',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'company_id' => 2,
                'company' => 'PT. Beta Security',
                'location' => 'Kantor Cabang Bandung',
                'location_type' => 'Kantor Cabang',
                'location_code' => 'KC01',
                'information' => 'Kantor operasional di wilayah Bandung',
                'status' => 'nonaktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
