<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Services\Category\DestroyCategory;
use App\Services\Category\IndexCategory;
use App\Services\Category\ShowCategory;
use App\Services\Category\StoreCategory;
use App\Services\Category\UpdateCategory;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResource
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
    public function store(Request $request): JsonResource|JsonResponse
    {
        try {
            $category = app(StoreCategory::class)->execute($request->all());
            return new CategoryResource($category);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResource|JsonResponse
    {
        try {
            $category = app(ShowCategory::class)->execute([
                'id' => $id
            ]);
            return new CategoryResource($category);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
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
    public function update(Request $request, $id): JsonResource|JsonResponse
    {
        try {
            app(UpdateCategory::class)->execute([
                'name' => $request->name,
                'id' => $id
            ]);
            return $this->show($id);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResource|JsonResponse
    {
        try {
            app(DestroyCategory::class)->execute([
                'id' => $id
            ]);
            return $this->respondObjectDeleted($id);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}
