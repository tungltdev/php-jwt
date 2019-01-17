<?php

namespace App\Http\Middleware;

use Closure;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jwt = @trim(explode(' ', $request->header('Authorization'))[1]);
        if (empty($jwt)) {
            return response()->json([
                'ok' => 0,
                'msg' => __('auth.check_jwt'),
                'data' => []
            ]);
        } else {
            try {
                $request->jwtUser = jwtdecode($jwt, array('HS256'));
            } catch (\Exception $e) {
                return response()->json([
                    'ok' => 0,
                    'msg' => __('auth.check_jwt'),
                    'data' => []
                ]);
            }
            return $next($request);
        }
    }
}
