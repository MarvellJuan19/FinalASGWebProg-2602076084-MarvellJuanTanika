<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jessen',
            'email' => 'jessen123ptk@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Male',
            'hobbies' => json_encode(['Play Games', 'Listening Music', 'Watch Movie']),
            'instagram_username' => 'https://www.instagram.com/jessen_',
            'mobile_number' => '082150709185',
            'preferred_location' => 'Cafe',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Asep',
            'email' => 'asep123@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Male',
            'hobbies' => json_encode(['Fishing', 'Racing', 'Play Games']),
            'instagram_username' => 'https://www.instagram.com/asep_',
            'mobile_number' => '081234567890',
            'preferred_location' => 'Cafe',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Siti',
            'email' => 'siti123@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Female',
            'hobbies' => json_encode(['Cooking', 'Listening Music', 'Photography']),
            'instagram_username' => 'https://www.instagram.com/siti_',
            'mobile_number' => '082112453678',
            'preferred_location' => 'Shopping Mall',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Ester',
            'email' => 'ester123@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Female',
            'hobbies' => json_encode(['Play Games', 'Singing', 'Swimming']),
            'instagram_username' => 'https://www.instagram.com/ester_',
            'mobile_number' => '087899067865',
            'preferred_location' => 'Shopping Mall',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi123@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Male',
            'hobbies' => json_encode(['Play Football', 'Cooking', 'Travelling']),
            'instagram_username' => 'https://www.instagram.com/budi_',
            'mobile_number' => '082112456678',
            'preferred_location' => 'Park',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Ayu',
            'email' => 'ayu123@gmail.com',
            'password' => Hash::make('password123#'), // Hash password
            'gender' => 'Female',
            'hobbies' => json_encode(['Travelling', 'Dancing', 'Swimming']),
            'instagram_username' => 'https://www.instagram.com/ayu_',
            'mobile_number' => '082145678894',
            'preferred_location' => 'Park',
            'registration_price' => random_int(100000, 125000),
            'wallet_balance' => 1000,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
