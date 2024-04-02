<?php

namespace App\Http\Middleware;

use App\Exceptions\UnavailableDomainException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Closure;
class CheckDomain
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     * @throws \Throwable
     */
    public function handle(Request $request, Closure $next): Response
    {
       throw_if(empty($request->header('domain')),UnavailableDomainException::class);
        return $next($request);
    }

}
