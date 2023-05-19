<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results=[
            [
                'collection_id'=>'1',
                'question_id'=>'1',
                'user_id'=>'1',
                'answer_id'=>'1',
                'is_correct'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'1',
                'question_id'=>'2',
                'user_id'=>'1',
                'answer_id'=>'2',
                'is_correct'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'1',
                'question_id'=>'3',
                'user_id'=>'2',
                'answer_id'=>'1',
                'is_correct'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'1',
                'question_id'=>'4',
                'user_id'=>'2',
                'answer_id'=>'2',
                'is_correct'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'1',
                'question_id'=>'5',
                'user_id'=>'3',
                'answer_id'=>'1',
                'is_correct'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'2',
                'question_id'=>'6',
                'user_id'=>'3',
                'answer_id'=>'2',
                'is_correct'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'3',
                'question_id'=>'5',
                'user_id'=>'3',
                'answer_id'=>'1',
                'is_correct'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'3',
                'question_id'=>'6',
                'user_id'=>'3',
                'answer_id'=>'2',
                'is_correct'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'3',
                'question_id'=>'5',
                'user_id'=>'1',
                'answer_id'=>'1',
                'is_correct'=>true,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
            [
                'collection_id'=>'3',
                'question_id'=>'6',
                'user_id'=>'2',
                'answer_id'=>'2',
                'is_correct'=>false,
                'created_at'=>now(),
                'updated_at'=>now(),
            ],
        ];
        DB::table('results')->insert($results);
    }
}
