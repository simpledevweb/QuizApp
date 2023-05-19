<?php

namespace App\Services\Result;

use App\Models\Collection;
use App\Models\Result;
use App\Models\User;
use App\Services\BasicService;

class CalculateResult  extends BasicService
{
    public function rules(): array
    {
        return [];
    }

    public function duplicate($data)
    {
        $data_ret = [];
        foreach ($data as $val) {
            if (!in_array($val, $data_ret)) {
                $data_ret[] = $val;
            }
        }
        return $data_ret;
    }

    public function execute()
    {
        $data = [];
        $results = collect(Result::all());
        $collections = collect(Collection::all());
        $users = collect(User::all());
        $collection_result = array($results->pluck('collection_id'))[0];
        $arr_collection = $this->duplicate($collection_result);

        foreach ($arr_collection as $collection) {
            $coll = $results->where('collection_id', '=', $collection);
            $user_result = array($coll->pluck('user_id'))[0];
            $arr_user = $this->duplicate($user_result);

            foreach ($arr_user as $user) {
                $corrects = $coll->where('user_id', $user)->where('is_correct', true)->count();
                $uncorrects = $coll->where('user_id', $user)->where('is_correct', false)->count();
                $data[] = [
                    'collection' => $collections->where('id', $collection)->first()->name,
                    'user' => $users->where('id', $user)->first()->name,
                    'corrects' => $corrects,
                    'uncorrects' => $uncorrects,
                ];
            }
        }
        return $data;
    }
}
