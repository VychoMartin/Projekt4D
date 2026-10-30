<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next, string ...$roles)
{
    $user = $request->user();

    if (! in_array($request->user()->role, $roles)) {
    return redirect()->route('home')
        ->with('error', 'K této stránce už nemáte oprávnění.');
}

    return $next($request);
}
}
