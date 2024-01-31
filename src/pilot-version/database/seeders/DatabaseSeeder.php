<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //テナントマスタ
        $this->call(M_TenantsSeeder::class);
        //一般ユーザーマスタ
        $this->call(M_UsersSeeder::class);
    }
}
