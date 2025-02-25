<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    /**
     * Return a successful response (HTTP 200).
     *
     * @param string $message The success message.
     * @param array $data The data to return in the response.
     * @return JsonResponse JSON response with success status.
     */
    protected function ok(string $message, array $data = []): JsonResponse
    {
        return $this->success($message, $data, 200);
    }

    /**
     * Return a successful response with the given status code.
     *
     * @param string $message The success message.
     * @param array $data The data to return in the response.
     * @param int $statusCode The HTTP status code for the response (default is 200).
     * @return JsonResponse JSON response with success status.
     */
    protected function success(string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Return an error response with the given status code.
     *
     * @param string $message The error message.
     * @param int $statusCode The HTTP status code for the error response.
     * @return JsonResponse JSON response with error status.
     */
    protected function error(string $message, int $statusCode): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
}
