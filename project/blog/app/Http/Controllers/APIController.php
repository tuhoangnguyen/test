<?php

namespace App\Http\Controllers;

use App\Services\AbstractService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //
    public function response(mixed $data, bool $status = true, string $message = ''): JsonResponse
    {
        if ($data instanceof AbstractService) {
            $status = $data->getStatus();
            if ($status) {
                $result = [
                    'status' => $status,
                    'message' => $data->getMessage(),
                    'data' => $data->getData(),
                ];
            } else {
                $result = [
                    'status' => $status,
                    'message' => $data->getMessage(),
                    'errors' => $data->getErrors(),
                ];
            }

            $statusCode = !empty($data->getStatusCode()) ? $data->getStatusCode() : 200;
            return response()->json($result, $statusCode);
        }

        return response()->json(
            $status ? $this->successMessage($data) : $this->errorMessage($data, $message)
        );
    }

    public function successMessage(mixed $data = []): array
    {
        return [
            'status' => true,
            'message' => __('api_response.success.common'),
            'data' => $data ?? [],
        ];
    }

    public function errorMessage(mixed $data = [], string $message = ""): array
    {
        return [
            'status' => false,
            'message' => $message ?? __('api_response.error.common'),
            'data' => $data ?? [],
        ];
    }
}
