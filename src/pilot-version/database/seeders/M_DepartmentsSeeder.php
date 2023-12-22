<?php

namespace Database\Seeders;

use App\Models\M_Tenants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class M_DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set_tenants_id = M_Tenants::select('tenant_id')->first()->tenant_id;
        DB::table('m_departments')->insert([
            [
                'tenant_id' => $set_tenants_id,
                'department_id' => 'test010',
                'department_name' => 'テスト用',
                'phone_number' => '000-111-2222',
                'address1' => 'テスト',
                'start_date' => now(),
                'updater' => 'テスト',
                'update_program' => 'テスト',
            ]
        ]);
    }
}
