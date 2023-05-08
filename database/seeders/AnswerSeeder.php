<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [
            [
                'question_id' => 1,
                'answer' => 'лень',
                'is_correct' => true,
            ],
            [
                'question_id' => 1,
                'answer' => 'урок',
                'is_correct' => false,
            ],
            [
                'question_id' => 1,
                'answer' => 'папка',
                'is_correct' => false,
            ],
            [
                'question_id' => 1,
                'answer' => 'карта',
                'is_correct' => false,
            ],
            [
                'question_id' => 2,
                'answer' => 'винный',
                'is_correct' => true,
            ],
            [
                'question_id' => 2,
                'answer' => 'извенение',
                'is_correct' => false,
            ],
            [
                'question_id' => 2,
                'answer' => 'обвинение',
                'is_correct' => false,
            ],
            [
                'question_id' => 2,
                'answer' => 'обвинить',
                'is_correct' => false,
            ],
            [
                'question_id' => 3,
                'answer' => 'on',
                'is_correct' => true,
            ],
            [
                'question_id' => 3,
                'answer' => 'for',
                'is_correct' => false,
            ],
            [
                'question_id' => 3,
                'answer' => 'at',
                'is_correct' => false,
            ],
            [
                'question_id' => 3,
                'answer' => 'of',
                'is_correct' => false,
            ],
            [
                'question_id' => 4,
                'answer' => 'have / won',
                'is_correct' => false,
            ],
            [
                'question_id' => 4,
                'answer' => 'has / win',
                'is_correct' => false,
            ],
            [
                'question_id' => 4,
                'answer' => 'have / win',
                'is_correct' => false,
            ],
            [
                'question_id' => 4,
                'answer' => 'has / won',
                'is_correct' => true,
            ],
            [
                'question_id' => 5,
                'answer' => '2',
                'is_correct' => true,
            ],
            [
                'question_id' => 5,
                'answer' => '3',
                'is_correct' => false,
            ],
            [
                'question_id' => 5,
                'answer' => '22',
                'is_correct' => false,
            ],
            [
                'question_id' => 5,
                'answer' => '12',
                'is_correct' => false,
            ],
            [
                'question_id' => 6,
                'answer' => '4',
                'is_correct' => true,
            ],
            [
                'question_id' => 6,
                'answer' => '6',
                'is_correct' => false,
            ],
            [
                'question_id' => 6,
                'answer' => '5',
                'is_correct' => false,
            ],
            [
                'question_id' => 6,
                'answer' => '13',
                'is_correct' => false,
            ],
        ];
        
        DB::table('answers')->insert($answers);
    }
}