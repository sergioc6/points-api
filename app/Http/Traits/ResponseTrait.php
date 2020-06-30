<?php


namespace App\Http\Traits;


use Illuminate\Http\Response;

trait ResponseTrait
{
    /**
     * Success response
     *
     * @param $data
     * @param null $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data, $message = null, $code = Response::HTTP_OK)
    {
        $response = ['status' => 'success'];
        isset($message) ? $response['message'] = $message : null;
        $response['data'] = $data;
        return response()->json($response, $code);
    }

    /**
     * Fail response
     *
     * @param $message
     * @param int $code
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function failResponse($message, $code = Response::HTTP_BAD_REQUEST, $data = null)
    {
        $response = ['status' => 'fail'];
        isset($message) ? $response['message'] = $message : null;
        isset($data) ? $response['data'] = $data : null;
        return response()->json($response, $code);
    }

    /**
     * Error response
     *
     * @param $message
     * @param int $code
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR, $data = null)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];
        isset($data) ? $response['data'] = $data : null;
        return response()->json($response, $code);
    }
}
