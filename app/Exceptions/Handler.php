<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Dotenv\Exception\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if($request->ajax()){
            $result = [
                "code"=>201,
                //这里使用 $exception->errors() 得到验证的所有错误信息，是一个关联二维数组，所以                使用了array_values()取得了数组中的值，而值也是一个数组，所以用的两个 [0][0]
                "msg"=>array_values($exception->errors())[0][0],
                "returnResult"=>null
            ];
            return response()->json($result);
        }
       /* if($request->is("/admin/user/*")){
            //如果错误是 ValidationException的一个实例，说明是一个验证的错误
            if($exception instanceof ValidationException){
                $result = [
                    "statusCode"=>ERR_PARAMETER,
                    //这里使用 $exception->errors() 得到验证的所有错误信息，是一个关联二维数组，所以                使用了array_values()取得了数组中的值，而值也是一个数组，所以用的两个 [0][0]
                    "errorMsg"=>array_values($exception->errors())[0][0],
                    "returnResult"=>null
                ];
                return response()->json($result);
            }
        }*/
        return parent::render($request, $exception);
    }
}
