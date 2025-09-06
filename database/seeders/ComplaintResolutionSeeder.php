<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComplaintResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('complaint_resolution')->insert([
            // Data 1 - Masalah kebersihan yang sudah dibersihkan
            // [
            
            //     'id' => 1,
            //     'date' => '2023-10-15',
            //     'employee_id' => 1, // Asumsi employee dengan id 1 ada
            //     'complaint_id' => 1, // Asumsi complaint dengan id 1 ada
            //     'doings' => 'dibersihkan',
            //     'photo_evidence' => 'cleaning_evidence1.jpg',
            //     'location_id' => 1, // Asumsi location dengan id 1 ada
    
            //     'notes' => 'Area sudah dibersihkan secara menyeluruh',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // // Data 2 - Masalah peralatan yang diperbaiki
            // [
            //     'id' => 2,
            //     'date' => '2023-10-16',
            //     'employee_id' => 2,
            //     'complaint_id' => 2,
            //     'doings' => 'diperbaiki',
            //     'photo_evidence' => 'repair_evidence1.jpg',
            //     'location_id' => 2,
           
            //     'notes' => 'Peralatan berhasil diperbaiki, menunggu konfirmasi',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            
        ]);
    }
}
