<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=[
            [
                'name'=>'Rus-til',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Ingliz-til',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Matematika',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Fizika',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Tarix',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Ximiya',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
