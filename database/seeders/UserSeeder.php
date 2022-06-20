<?php

namespace Database\Seeders;

use App\Models\BalanceMutation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Anas Badru Salam',
            'email' => 'anasbadrusalam@gmail.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now()
        ]);

        $admin->assignRole('admin');
        $admin->assignRole('user');

        $user = User::create([
            'name' => 'Badru Salam Anas',
            'email' => 'badrusalamanas@gmail.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now()
        ]);

        $user->assignRole('user');

    }
}
