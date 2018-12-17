<?php
namespace Users\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasRoleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param array ...$roles
     * @return \Illuminate\Contracts\Routing\ResponseFactory|mixed|\Symfony\Component\HttpFoundation\Response|void
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::user()->hasRole($roles)) {
            if ($request->ajax()) {
                return response('Unauthorized.', 403);
            }
            return abort(403);
        }

        return $next($request);
    }
}