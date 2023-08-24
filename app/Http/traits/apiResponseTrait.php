<?php

namespace App\Http\traits;
/**
 * Trait To Handel Api Response
 */
trait apiResponseTrait
{

    public function apiResponse($data = null ,$msg = null ,$status = null)
    {
        return response()->json([
            'status' =>$status,
            'message' =>$msg,
            'data' => $data,
        ], $status);
    }


    public function responseSucsses(mixed $data , int $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => 'successfully',
            'data' => $data
        ],$code);
    }


    public function responseError(mixed $error , int $code = 400)
    {
        return response()->json([
            'status' => $code,
            'message' => 'error',
            'errors' => [
                'errorDescription' => $error
            ]
        ],$code);
    }


    public function returnData(string $key ,mixed $val , int $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => 'successfully',
            $key => $val
        ],$code);
    }


}

?>
