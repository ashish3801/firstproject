<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Route;
use DB;
use Auth;


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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        // return parent::render($request, $exception);
        if ($this->shouldReport($exception)) 
        {

            $currentPath= Route::getFacadeRoot()->current()->uri();
            
            
            $arr['getMessage'] = $exception->getMessage();
            $arr['getFile'] = $exception->getFile();
            $arr['getLine'] = $exception->getLine();
            $arr['getTrace'] = $exception->getTrace();
            $arr['user_id'] = Auth::check() ? auth()->user()->id : NULL;
            $arr['user_name'] = Auth::check() ? auth()->user()->firstname : NULL;
            $arr['route'] = $currentPath;

            // dd($arr);

            DB::table('system_errors')->insert([
                'message' => $arr['getMessage'],
                'file' => $arr['getFile'],
                'line' => $arr['getLine'],
                'user_id' => $arr['user_id'],
                'user_name' => $arr['user_name'],
                'route'=>$currentPath,
                'created_at'=>date('Y-m-d'),
                // 'message'=>$arr['getMessage'],
                'url'=>url('/'),
            ]);

            // $arr['url'] = $exception->url();
            // $arr['all'] = $exception->all();
            // $arr['ip'] = $exception->ip();
        }
        return parent::render($request, $exception);
    }
    
}
