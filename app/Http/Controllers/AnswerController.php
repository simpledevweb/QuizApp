<?php

namespace App\Http\Controllers;

use App\Http\Resources\Answer\AnswerResource;
use App\Models\Answer;
use App\Services\Answer\StoreAnswer;
use App\Services\Answer\UpdateAnswer;
use App\Services\Answer\DestroyAnswer;
use App\Traits\JsonRespondController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    use JsonRespondController;
    public function store(Request $request): JsonResource|JsonResponse
    {
        try {
            app(StoreAnswer::class)->execute($request->all());
            return $this->respondSuccess();
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }

    public function update(Request $request, $id): JsonResource|JsonResponse
    {
        try {
            app(UpdateAnswer::class)->execute([
                'id' => $id,
                'question_id' => $request->question_id,
                'answer' => $request->answer,
                'is_correct' => $request->is_correct,
            ]);
            return new AnswerResource(Answer::find($id));
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
    public function destroy($id): JsonResponse
    {
        try {
            $answer = app(DestroyAnswer::class)->execute([
                'id' => $id
            ]);
            return $this->respondObjectDeleted($id);
        } catch (ValidationException $exception) {
            return $this->respondValidatorFailed($exception->validator);
        } catch (Exception $exception) {
            return $this->respondNotFound();
        }
    }
}
