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
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Godfred',
            'last_name' => 'Akpan',
            'email_address' => 'godfredakpan@gmail.com',
            'phone_number' => '+2349036709916',
            'residential_address' => 'Lekki',
            'password' => Hash::make('Password2022'),
            'profile_picture' => 'profile_link',
        ]);
    }
}
