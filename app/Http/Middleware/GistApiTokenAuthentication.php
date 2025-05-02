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
        $secret            = config('getgist.client_secret');
        $data              = $request->getContent();
        $expectedSignature = 'sha256=' . hash_hmac('sha256', $data, $secret);
        $actualSignature   = $request->header('x-gist-signature');

        if (!hash_equals($expectedSignature, $actualSignature)) {
            return response()->json([
                'canvas' => [
                    'content' => [
                        'components' => [
                            [
                                'type' => 'text',
                                'text' => 'Invalid signature!',
                            ]
                        ]
                    ],
                ]
            ], 401);
        }

        return $next($request);
    }
}
