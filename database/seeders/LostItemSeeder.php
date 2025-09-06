<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class LostItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $statusOptions = ['hilang', 'ditemukan'];

        for ($i = 0; $i < 20; $i++) {
            DB::table('lost_items')->insert([
                'lost_name' => $faker->name,
                'item_name' => ucfirst($faker->word),
                'lost_location' => $faker->city,
                'lost_date' => $faker->optional()->date(),
                'photo' => 'images/lost_items/' . $faker->image('public/storage/lost_photos', 640, 480, null, false),
                'status' => $faker->randomElement($statusOptions),
                'description' => $faker->sentence(15),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
