<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationDivisionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('location_divisions')->insert([
            [
                 'id' => 1,
                'employee_id' => 1,
                'cooperation_id' => 1,
                'location_id' => 1,
                'work_id' => 1,
                'detail_work' => 'Pemasangan AC di ruang meeting lantai 2',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'employee_id' => 2,
                'cooperation_id' => 2,
                'location_id' => 2,
                'work_id' => 2,
                'detail_work' => 'Perbaikan jaringan internet di laboratorium komputer',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                 'id' => 3,
                'employee_id' => 3,
                'cooperation_id' => 3,
                'location_id' => 3,
                'work_id' => 3,
                'detail_work' => 'Pembersihan dan pengecatan ulang dinding aula',
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
