<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_orders')->insert([
            'work_order_id' => Str::random(10),
            'priority' => 'Important',
            'maintenance_type' => 'Preventive Maintenance',
            'status' => 'In progress',
            'date_finished' => Carbon::parse('2020-10-10'),
            'remarks' => 'Fast',
            'asset_id' => 1,
            'supervisor_id' => 1,
            'technician_id' => 1
        ]);
    }
}
