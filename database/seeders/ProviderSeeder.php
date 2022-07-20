<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            'name' => 'telkomsel',
            'min' => 50000,
            'max' => 1000000,
            'max_balance' => 1030000,
            'rate' => 0.7,
            'limit_counter' => 100,
            'expired_time' => 30,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('providers')->insert([
            'name' => 'xl/axis',
            'min' => 50000,
            'max' => 2000000,
            'max_balance' => 10100000,
            'rate' => 0.75,
            'limit_counter' => 100,
            'expired_time' => 30,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('providers')->insert([
            'name' => 'tri',
            'min' => 50000,
            'max' => 200000,
            'max_balance' => 1030000,
            'rate' => 0.8,
            'limit_counter' => 100,
            'expired_time' => 30,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('providers')->insert([
            'name' => 'indosat',
            'min' => 50000,
            'max' => 200000,
            'max_balance' => 1030000,
            'rate' => 0.75,
            'limit_counter' => 100,
            'expired_time' => 30,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
