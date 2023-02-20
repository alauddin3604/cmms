<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Muhammad Alauddin',
            'email' => 'alauddin3604@gmail.com',
            'phone_number' => '0183240906',
            'password' => Hash::make('Alauddin98') 
        ]);
    }
}
