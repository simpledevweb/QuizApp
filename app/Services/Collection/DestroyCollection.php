<?php

namespace App\Services\Collection;

use App\Models\AllowedUser;
use App\Models\Answer;
use App\Models\Collection;
use App\Models\Question;
use App\Services\BasicService;
use App\Services\Question\DestroyQuestion;

class DestroyCollection extends BasicService
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:collections,id'
        ];
    }

    public function execute($data)
    {
        $this->validate($data);
        $collection = Collection::find($data['id']);
        $questions = $collection->questions;
        foreach ($questions as $question) {
            app(DestroyQuestion::class)->execute([
                'id' => $question->id,
            ]);
        }
        AllowedUser::where('collection_id',$collection->id)->delete();
        $collection->delete();
        return true;
    }
}
