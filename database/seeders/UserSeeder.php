<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'diki',
            'email' => 'diki@gmail.com',
            'password' => '@Diki123',
            'gender' => 'Male',
            'hobby' =>  'Makan, Tidur, Main',
            'instagram_username' => 'https://www.instagram.com/marvell',
            'mobile_number' => '08123693321',
            'registration_fee' => '123456'
        ]);

        for ($i=1; $i < 6; $i++) { 
            User::create([
                'name' => 'User '.$i,
                'email' => 'user'.$i.'@gmail.com',
                'password' => 'user123',
                'gender' => rand(0, 2) == 0 ? 'Female' : 'Male',
                'hobby' => rand(0, 2) == 0 ? ('Makan, Tidur, Main') : ('Makan, Minum, Belajar'),
                'instagram_username' => 'https://www.instagram.com/marvell',
                'mobile_number' => '12345678900',
                'registration_fee' => random_int(100000, 125000)
            ]);
        }
    }
}