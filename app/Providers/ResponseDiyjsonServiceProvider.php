<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseDiyjsonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('diyjson', function ($code=200, $data=null, $msg=null) {
            $content =  array(
                'code'    =>  $code,
                'data'    =>  $data,
                'msg'     =>  $msg
            );
            return response()->json($content);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
