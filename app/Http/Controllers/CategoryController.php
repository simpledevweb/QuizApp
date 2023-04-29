<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\DestroyCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = app(IndexCategory::class)->execute([]);
        return CategoryResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * 
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $category = app(StoreCategory::class)->execute($request->all());
            return new CategoryResource($category);
        } catch (ValidationException $exception) {
            return $exception->validator->errors()->all();
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
            $category = app(ShowCategory::class)->execute([
                'id' => $id
            ]);
            return new CategoryResource($category);
        }catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all(),
            ], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
            app(UpdateCategory::class)->execute([
                'name' => $request->name,
                'id' => $id
            ]);
            return $this->show($id);
        } catch (ValidationException $exception) {
            return response([
                'errors' => $exception->validator->errors()->all(),
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   try {
        app(DestroyCategory::class)->execute([
            'id' => $id
        ]);
        return response([
            'successful'=>true
        ]);
    } catch (ValidationException $exception) {
        return response([
            'errors' => $exception->validator->errors()->all(),
        ], 422);
    }
    }
}
