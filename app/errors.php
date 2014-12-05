<?php

App::missing(function($exception)
{
    return Response::view('errors.default', [
                                             'title' => '404 Not Found',
                                             'message' => "Sorry, we can't find that page."
                                             ], 404);
});

App::error(function(Exception $exception, $code)
{
    $message = $exception->getMessage();
	Log::error($exception);
    switch ($code) {
        case 400:
            return Response::view('errors.default', [
                                                     'title' => '400 Bad Request',
                                                     'message' => "Sorry, we can't process your request"
                                                     ], $code);
        case 401:
           return Response::view('errors.default', [
                                                     'title' => '401 Unauthorized',
                                                     'message' => "Sorry, we can't process your request"
                                                     ], $code);
        case 403:
           return Response::view('errors.default', [
                                                     'title' => '403 Forbidden',
                                                     'message' => "You don't have permission to access"
                                                     ], $code);
        case 500:
           return Response::view('errors.default', [
                                                    'title' => '500 Internal Server Error',
                                                    'message' => "Sorry, our developers will fix this problem asap."
                                                    ], $code);
        case 503:
           return Response::view('errors.default', [
                                                    'title' => '503 Temporarily Unavailable',
                                                    'message' => "Please try again later",
                                                    ], $code);
    }
});
