<?php

namespace Database\Seeders;

use App\Models\M_Tenants;
use Database\Factories\M_UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class M_UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $set_tenants_id = M_Tenants::select('tenant_id')->first()->tenant_id;
        DB::table('m_users')->insert([
            [
                'tenant_id'
                => $set_tenants_id,
                'user_id' => 'test001',
                'user_name' => 'tester',
                'email' => 'test@test.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'department_id' => 'TEST001',
                'start_date' => now(),
                'updated_by' => 'テスト',
                'update_program' => 'テスト',
            ]
        ]);
    }
}
