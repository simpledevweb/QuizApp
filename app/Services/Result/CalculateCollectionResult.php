<?php

namespace App\Services\Result;

use App\Models\Collection;
use App\Models\Result;
use App\Models\User;
use App\Services\BasicService;

class CalculateCollectionResult  extends BasicService
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
        $users = collect(User::all());
        $collections = collect(Collection::all());
        $collections_res = $results->pluck('collection_id');
        $collections_res = $this->duplicate($collections_res);
        foreach ($collections_res as $collection) {
            $data1 = [];
            $users_res = $results->where('collection_id', $collection)->pluck('user_id');
            foreach ($users_res as $user) {
                $data1[] = [
                    'user' => $users->where('id', $user)->first()->name
                ];
            }
            $data[] = [
                'collection' => $collections->where('id', $collection)->first()->name,
                'users' => $data1
            ];
        }
        return response([
            'data' => $data
        ]);
    }
}
