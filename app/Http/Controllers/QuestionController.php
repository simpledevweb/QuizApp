<?php

namespace App\Http\Controllers;

use App\Http\Resources\Question\QuestionWithAnswersResource;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Question;
use App\Services\Question\DestroyQuestion;
use App\Services\Question\IndexQuestion;
use App\Services\Question\ShowQuestion;
use App\Services\Question\StoreQuestion;
use App\Services\Question\UpdateQuestion;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
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
            $questions = app(IndexQuestion::class)->execute($request->all());
            return new QuestionCollection($questions);
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
    public function store(Request $request): JsonResource|JsonResponse
    {
        try {
            app(StoreQuestion::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exceptoin) {
            return $this->respondValidatorFailed($exceptoin->validator);
        } catch (Exception $exceptoin) {
            return $this->respondNotFound();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):JsonResponse|JsonResource
    {
        try {
            [$question, $answers]=app(ShowQuestion::class)->execute([
                'id'=>$id
            ]);
            return (new QuestionWithAnswersResource($question))->setAnswers($answers);
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
        try{
            app(UpdateQuestion::class)->execute($request->all());
            return new QuestionResource(Question::find($id));
        }catch (ValidationException $exception) {
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
    public function destroy($id):JsonResource|JsonResponse
    {
        try{
            app(DestroyQuestion::class)->execute([
                'id'=>$id
            ]);
            return $this->respondObjectDeleted($id);
        }catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
}
