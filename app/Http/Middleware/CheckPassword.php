<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;

class CheckPassword
{
    use GeneralTrait;

    public function handle(Request $request, Closure $next)
    {
        if($request->api_password != env('API_PASSWORD','OuvMzoJBZtV16sO26o')){
            return $this->returnError('401','Unauthenticated');
        }
        return $next($request);
    }
}
