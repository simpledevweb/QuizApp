<?php

namespace App\Http\Controllers;

use App\Http\Resources\Collection\CollectionCollection;
use App\Http\Resources\Collection\CollectionResource;
use App\Http\Resources\Collection\CollectionWithQuestionsResource;
use App\Models\Collection;
use App\Services\Collection\IndexCollection;
use App\Services\Collection\ShowCollection;
use App\Services\Collection\StoreCollection;
use App\Services\Collection\UpdateCollection;
use App\Services\Collection\DestroyCollection;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CollectionController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse|CollectionCollection
    {
        try {
            $collections = app(IndexCollection::class)->execute($request->all());
            return new CollectionCollection($collections);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            $code = is_string($exception->getCode()) ? 500 : $exception->getCode();
            return $this->respondError($exception->getMessage(), [], $code);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        try {
            app(StoreCollection::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }catch (Exception $exception) {
            $code = is_string($exception->getCode()) ? 500 : $exception->getCode();
            return $this->respondError($exception->getMessage(), [], $code);
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
            [$collection, $questions] = app(ShowCollection::class)->execute([
                'id' => $id
            ]);
            return (new CollectionWithQuestionsResource($collection))->setQuestions($questions);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            $code = is_string($exception->getCode()) ? 500 : $exception->getCode();
            return $this->respondError($exception->getMessage(), [], $code);
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
                'id' => $id,
                'category' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'allowed_type' => $request->allowed_type
            ]);
            return new CollectionResource(Collection::find($id));
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }catch (Exception $exception) {
            return $this->respondNotFound();
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
            return $this->respondObjectDeleted($id);
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}
