<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $users=[
            [
                'name'=>'Alpamis Ibraymov',
                'phone'=>'+998913795859',
                'password'=>Hash::make(1904),
                'is_premium'=>true,
                'is_admin'=>true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Jangabaev Raxat',
                'phone'=>'+998913882909',
                'password'=>Hash::make(1111),
                'is_premium'=>false,
                'is_admin'=>true,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Qutilmuratov Alisher',
                'phone'=>'+998911234567',
                'password'=>Hash::make(2222),
                'is_premium'=>true,
                'is_admin'=>false,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'name'=>'Jusipov Asadbek',
                'phone'=>'+998911111111',
                'password'=>Hash::make(1234),
                'is_premium'=>false,
                'is_admin'=>false,
                'created_at'=> now(),
                'updated_at'=> now()
                ]
            ];
            DB::table('users')->insert($users);
    }
}
