<?php

namespace App\Exceptions;

use App\Actions\ApiActions;
use App\Constants\ResponseCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e,$request) {
            if ($request->expectsJson()) {
                return ApiActions::generateResponse(null,'no_data',ResponseCode::NOT_FOUND);
            }
        });
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()||$request->routeIs('*/api/*')
            ? ApiActions::generateResponse(null,'not_authenticated',ResponseCode::UNAUTHORIZED)
            : redirect()->guest($exception->guards()[0]=='admin'?route('admin.login'):$exception->redirectTo() ?? route('login'));
    }
    protected function invalidJson($request, ValidationException $exception)
    {
        if(str_contains($request->url(),'api/')){
            $first_message='';
            foreach ($exception->errors() as $key=>$value){
                $col=collect($value);
                $first_message=$col->first();
                break;
            }


            return ApiActions::generateResponse($first_message,'validation_error',ResponseCode::VALIDATION_ERROR);

        }else{
            $err=[];
            foreach ($exception->errors() as $key=>$value){
                $col=collect($value);
                $n= new \stdClass();
                $n->field=$key;
                $n->error=$col->first();
                $err[]=$n;
            }

            return ApiActions::generateResponseDash(['errors'=>$err],'validation_error',ResponseCode::VALIDATION_ERROR);

        }

    }


}
