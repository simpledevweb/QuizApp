<?php

namespace App\Http\Controllers;

use App\Http\Resources\CollectionResource;
use App\Services\Collection\DestroyCollection;
use App\Services\Collection\IndexCollection;
use App\Services\Collection\ShowCollection;
use App\Services\Collection\StoreCollection;
use App\Services\Collection\UpdateCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = app(IndexCollection::class)->execute();
        return CollectionResource::collection($collections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $collection = app(StoreCollection::class)->execute([
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
                'name' => $request->name,
                'description' => $request->description,
                'allowed_type' => $request->allowed_type,
            ]);
            return new CollectionResource($collection);
        } catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $collection = app(ShowCollection::class)->execute([
                'id' => $id
            ]);
            return new CollectionResource($collection);
        } catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            app(UpdateCollection::class)->execute([
                'id'=>$id,
                'category_id'=>$request->category_id,
                'user_id'=>$request->user_id,
                'name'=>$request->name,
                'description'=>$request->description,
                'allowed_type'=>$request->allowed_type
            ]);
            return $this->show($id);
        } catch (ValidationException $exception) {
            return response([
                'errors'=>$exception->validator->errors()->all()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            app(DestroyCollection::class)->execute([
                'id' => $id
            ]);
            return response([
                'successful' => true
            ]);
        } catch (ValidationException $exception) {
            return response([
                'errors'=>$exception->validator->errors()->all()
            ]);
        }
    }
}
