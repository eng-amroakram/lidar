<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Amro',
            'last_name' => 'Akram',
            // 'otp_code' => null,
            'email' => 'eng.amroakram@gmail.com',
            'phone' => '599916672',
            'email_verified_at' => now(),
            'password' => Hash::make("123456"),
        ]);
    }
}
