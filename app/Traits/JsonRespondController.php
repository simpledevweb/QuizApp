<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

trait JsonRespondController
{
    protected int $httpStatusCode = 200;
    public function getHTTPStatusCode()
    {
        return $this->httpStatusCode;
    }
    public function setHTTPStatusCode(int $statusCode): static
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }
    public function respond(array $data, array $headers = []): JsonResponse
    {
        return response()->json([
            'data' => $data
        ], $this->getHTTPStatusCode(), $headers);
    }
    public function respondValidatorFailed(Validator $validator): JsonResponse
    {
        return $this->respondError($validator->errors()->first(), $validator->errors()->all(),422);
    }
    public function respondObjectDeleted(int $id): JsonResponse
    {
        return $this->respond([
            'deleted' => true,
            'id' => $id,
        ]);
    }
    public function respondError($error = '', $errors = [], $code = 422): JsonResponse
    {
        return $this->setHTTPStatusCode($code)->respond([
            'error' => $error,
            'errors' => $errors
        ]);
    }
    public function respondSuccess($code = 200): JsonResponse
    {
        return $this->setHTTPStatusCode($code)->respond([
            'success' => true,
        ]);
    }
    public function respondNotFound(): JsonResponse
    {
        return $this->respondError('Not found',[],404);
    }
}
