<?php

namespace App\Http\Controllers;

use App\Http\Resources\Allowed_user\AllowedResource;
use App\Models\AllowedUser;
use App\Services\Allowed_user\IndexAllowed;
use App\Services\Allowed_user\ShowAllowed;
use App\Services\Allowed_user\StoreAllowed;
use App\Services\Allowed_user\UpdateAllowed;
use App\Services\Allowed_user\DestroyAllowed;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class AllowedUserController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResource|JsonResponse
    {
        try {
            $allowed = app(IndexAllowed::class)->execute();
            return AllowedResource::collection($allowed);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
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
            app(StoreAllowed::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
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
            $allowed = app(ShowAllowed::class)->execute([
                'id' => $id
            ]);
            return new AllowedResource($allowed);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id):JsonResource|JsonResponse
    {
        try {
            app(UpdateAllowed::class)->execute([
                'id'=>$id,
                'user_id'=>$request->user_id,
                'collection_id'=>$request->collection_id,
            ]);
            return new AllowedResource(AllowedUser::find($id));
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id):JsonResponse
    {
        try {
            app(DestroyAllowed::class)->execute([
                'id'=>$id
            ]);
            return $this->respondObjectDeleted($id);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
}
