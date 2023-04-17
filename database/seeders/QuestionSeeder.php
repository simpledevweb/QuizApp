<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions=[
            [
                'collection_id'=>1,
                'question'=>'Какое слово нельзя  разделить на части для переноса?',
                'correct_answers'=>1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'collection_id'=>1,
                'question'=>'Какое из слов не является родственным?',
                'correct_answers'=>1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'collection_id'=>2,
                'question'=>'Brad and Marilyn are _____ honeymoon.',
                'correct_answers'=>1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'collection_id'=>2,
                'question'=>' Monica _____ many tournaments?',
                'correct_answers'=>1,
                'created_at'=> now(),
                'updated_at'=> now()
                ]
            ];
        
            DB::table('questions')->insert($questions);
    }
}
