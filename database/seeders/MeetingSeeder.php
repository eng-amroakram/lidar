<?php

namespace Database\Seeders;

use App\Models\Meeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Meeting::create([
            'title' => 'LiGAURD',
            'date' => $faker->dateTimeBetween('-1 month', '+1 month'),
            'participants_number' => $faker->numberBetween(10, 50),
            'recording_attempts' => $faker->numberBetween(0, 3),
            'username' => 'رنا علي الغامدي',
            'id_number' => '442926852',
            'status' => 'Blocked',
            'restricted_image' => $faker->imageUrl(200, 200, 'abstract', true), // Fake image URL
        ]);
    }
}
