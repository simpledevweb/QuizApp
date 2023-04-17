<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        $collections=[
            [
                'category_id'=>1,
                'user_id'=>1,
                'name'=>'Elementry Rus-tili',
                'description'=>'Bul collection Rus-tilinen baslangish sorawlar',
                'code'=>1,
                'allowed_type'=>'public',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'category_id'=>2,
                'user_id'=>2,
                'name'=>'Elementry Ingliz-tili',
                'description'=>'Bul collection Ingliz-tilinen baslangish sorawlar',
                'code'=>2,
                'allowed_type'=>'url',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'category_id'=>3,
                'user_id'=>3,
                'name'=>'Elementry Matematika',
                'description'=>'Bul collection Matematika baslangish sorawlar',
                'code'=>3,
                'allowed_type'=>'limited users',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ];
        
        DB::table('collections')->insert($collections);
    }
}
