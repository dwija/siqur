<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user')->insert([
            'username' => '4dmin',
            'email' => '4dmin@rumaharisha.xyz',
            'password' => Hash::make('Admin10'),
            'full_name' => 'Super Admin',
            'status' => 10,
            'account_type' => 10
        ]);
    }
}