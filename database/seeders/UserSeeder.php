<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'root_user',
            'email' => 's8.9.mv0e1mm2fd@gmail.com',
            'password' => Hash::make('HMspns11'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
