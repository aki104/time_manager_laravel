<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('staffs')->insert([
            'name' => 'テスト太郎',
            'email' => 'test@test.jp',
            'company_code' => '0001',
            'employee_code' => '001',
            'password' => 'password1',
            'attendance_status' => 0
          ]);

        DB::table('staffs')->insert([
          'name' => 'テスト二郎',
          'email' => 'test2@test2.jp',
          'company_code' => '0002',
          'employee_code' => '002',
          'password' => 'password1',
          'attendance_status' => 1
        ]);
    }
}
