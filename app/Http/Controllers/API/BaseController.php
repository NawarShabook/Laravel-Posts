<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //Base Controller for send request and response to and from my web app

    public function sendResponse($result, $message)
    {
        //sendResponse function for successful procedures

        $response=[
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
        //json fun for send data as json code, 200 is successs code
    }

    public function sendError($error, $errorMessage=[] , $code=404)
    {
        //sendError function for fail procedures

        $response=[
            'success' => false,
            'data' => $error,
        ];

        if(!empty($errorMessage))
        {
            $response['data']=$errorMessage;
        }

        return response()->json($response, $code);
        //json fun for send data as json code, 404 is fail code
    }
}
