<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('complaints')->insert([
            // [
            //     'id' => 1,
            //     'visitor_name' => 'John Doe',
            //     'customer_phone' => '081234567890',
            //     'description' => 'The parking area is very dirty with lots of trash scattered around.',
            //     'proof_image' => 'complaints/parking_dirty.jpg',
            //     'status' => 'pending',
            //     'location_id' => 1,
            //     'employee_id' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'id' => 2,
            //     'visitor_name' => 'Jane Smith',
            //     'customer_phone' => '082345678901',
            //     'description' => 'The restroom in the east wing has a broken sink and no running water.',
            //     'proof_image' => 'complaints/restroom_broken.jpg',
            //     'status' => 'processed',
            //     'location_id' => 2,
            //     'employee_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'id' => 3,
            //     'visitor_name' => 'Robert Johnson',
            //     'customer_phone' => '083456789012',
            //     'description' => 'Loud noise from construction work after permitted hours is disturbing residents.',
            //     'proof_image' => 'complaints/noise_complaint.mp4',
            //     'status' => 'resolved',
            //     'location_id' => 3,
            //     'employee_id' => 2,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'id' => 4,
            //     'visitor_name' => 'Sarah Williams',
            //     'customer_phone' => '084567890123',
            //     'description' => 'The elevator in building B has been out of service for 3 days now.',
            //     'proof_image' => null,
            //     'status' => 'rejected',
            //     'location_id' => 1,
            //     'employee_id' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
