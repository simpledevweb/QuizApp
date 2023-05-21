<?php

namespace App\Http\Controllers;

use App\Http\Resources\Result\ResultCollection;
use App\Models\Collection;
use App\Models\Question;
use App\Models\Result;
use App\Models\User;
use App\Services\Result\CalculateCollectionResult;
use App\Services\Result\CalculateQuestionResult;
use App\Services\Result\IndexResult;
use App\Services\Result\StoreResult;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;
use App\Services\Result\CalculateResult;

class ResultController extends Controller
{
    use JsonRespondController;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResource|JsonResponse
    {
        try {
            $results = app(IndexResult::class)->execute($request);
            return new ResultCollection($results);
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
            app(StoreResult::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
    public function calculate()
    {
        try {
            return app(CalculateResult::class)->execute();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    public function calculateQuestion()
    {
        try {
            return app(CalculateQuestionResult::class)->execute();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    public function calculateCollection()
    {
        try {
            return app(CalculateCollectionResult::class)->execute();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
}
