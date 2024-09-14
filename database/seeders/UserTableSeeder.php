<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Eidtor',
                'email' => 'eidtor@gmail.com',
                'password' => Hash::make('123456')
            ],
        ];
        User::truncate();
        DB::table('users')->insert($users);
    }
}
