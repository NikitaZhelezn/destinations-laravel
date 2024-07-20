<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController extends Controller
{
    private const RESPONSE_STATUS_SUCCESS = 'Success';

    private const RESPONSE_STATUS_FAILED = 'Failed';

    protected function response(array $body = [], int $code = Response::HTTP_OK): JsonResponse
    {
        $body['status'] = $this->getResponseStatus($code);

        return response()->json($body, $code);
    }

    protected function responseSuccess(string $message = 'Success', int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->response(['message' => $message], $code);
    }

    protected function responseError(string $error = '', int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->response(['error' => $error], $code);
    }

    private function getResponseStatus($code): string
    {
        return in_array($code, [Response::HTTP_OK, Response::HTTP_CREATED])
            ? self::RESPONSE_STATUS_SUCCESS
            : self::RESPONSE_STATUS_FAILED;
    }
}
