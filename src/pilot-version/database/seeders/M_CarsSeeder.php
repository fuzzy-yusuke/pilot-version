<?php

namespace Database\Seeders;

use App\Models\M_Tenants;
use App\Models\M_Departments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class M_CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set_tenants_id = M_Tenants::select('tenant_id')->first()->tenant_id;
        $set_departments_id = M_Departments::select('department_id')->first()->department_id;
        DB::table('m_cars')->insert([
            [
                'tenant_id' => $set_tenants_id,
                'car_id' => 'C001',
                'car_type' => 'トヨタ・プリウス',
                'number_plate' => '11-22',
                'start_date' => now(),
                'department_id' => $set_departments_id,
                'updated_by' => 'テスト',
                'update_program' => 'テスト',
            ]
        ]);
    }
}
