<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supervisor::create([
            'name' => Str::random(10),
            'ic_number' => '4312326576',
            'email' => Str::random(10).'@gmail.com',
            'phone_number' => '012932219',
            'address' => '12, Jalan Orkid 23'
        ]);
    }
}
