<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class M_TenantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_tenants')->insert([
            [
                'tenant_id' => (string)Str::uuid(),
                'tenant_name1' => 'TEST',
                'start_date' => now(),
                'admin_email' => 'test@test.com',
                'phone_number' => '03-111-2222',
                'address1' => 'テスト',
                'updated_by' => 'テスト',
                'update_program' => 'テスト',
            ]
        ]);
    }
}
