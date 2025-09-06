<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Data pertama: Absen masuk dan pulang lengkap, menunggu approval Admin
        $endTime1 = Carbon::now();
        $notes1 = $endTime1 ? 'Hadir' : 'Tidak Hadir';
        $status1 = $endTime1 ? 'incompleted' : 'incompleted'; // Tetap incompleted meskipun end_time ada, menunggu approval

        // Data kedua: Hanya absen masuk, belum pulang
        $endTime2 = null;
        $notes2 = $endTime2 ? 'Hadir' : 'Tidak Hadir';
        $status2 = 'incompleted'; // Status default saat baru absen masuk

        // Data ketiga: Absen masuk dan pulang lengkap (kemarin), sudah di-approve Admin (contoh)
        $endTime3 = Carbon::now()->subDay()->setTime(17, 0, 0);
        $notes3 = $endTime3 ? 'Hadir' : 'Tidak Hadir';
        $status3 = 'completed'; // Contoh data yang sudah di-approve

        // Data keempat: Absen masuk dan pulang lengkap (kemarin), BELUM di-approve Admin (contoh)
        $endTime4 = Carbon::now()->subDays(2)->setTime(17, 30, 0);
        $notes4 = $endTime4 ? 'Hadir' : 'Tidak Hadir';
        $status4 = 'incompleted';


        DB::table('attendances')->insert([
            [
                'id' => 1,
                "name"=>"name",
                'employee_id' => 1,
                'date' => Carbon::now()->toDateString(),
                'start_time' => Carbon::now()->subHours(8),
                'end_time' => $endTime1,
                'photo' => 'photos/attendance/photo1.png',
                'end_photo' => 'photos/attendance/end_photo1.png',
                'notes' => $notes1,
                'status' => $status1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                "name"=>"name",
                'employee_id' => 2,
                'date' => Carbon::now()->toDateString(),
                'start_time' => Carbon::now()->subHours(6),
                'end_time' => $endTime2,
                'photo' => 'photos/attendance/photo2.png',
                'end_photo' => null,
                'notes' => $notes2,
                'status' => $status2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                                'id' => 3,
                                                "name"=>"name",
                'employee_id' => 2,
                'date' => Carbon::now()->subDay()->toDateString(),
                'start_time' => Carbon::now()->subDay()->setTime(8, 0, 0),
                'end_time' => $endTime3,
                'photo' => null,
                'end_photo' => null,
                'notes' => $notes3,
                'status' => $status3, // Contoh 'completed'
                'created_at' => now(),
                'updated_at' => now(),
            ]
            // [
            //     'employee_id' => 1, // Karyawan 1 lagi, beda hari
            //                     "name"=>"name",

            //     'date' => Carbon::now()->subDays(2)->toDateString(),
            //     'start_time' => Carbon::now()->subDays(2)->setTime(8, 15, 0),
            //     'end_time' => $endTime4,
            //     'photo' => 'photos/attendance/photo_alt1.png',
            //     'end_photo' => 'photos/attendance/end_photo_alt1.png',
            //     'notes' => $notes4,
            //     'status' => $status4, // Contoh 'incompleted' meskipun sudah ada end_time
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);

        $this->command->info('Attendance table seeded with static data and admin approval status logic!');
    }
}