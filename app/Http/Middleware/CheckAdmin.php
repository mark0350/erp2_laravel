<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->id == 1)
            return $next($request);
        Response::make(['message' => '无权限'])->throwResponse();
    }
}
