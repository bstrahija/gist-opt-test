<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GistApiTokenAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appId = $request->input('app_id');
        $token = $request->input('token');

        // echo '<pre>';
        // print_r($request->header());
        // echo '</pre>';
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die();

        // if ($request->input('token') !== 'my-secret-token') {
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        return $next($request);
    }
}
