<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSellerIsActiveSubscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user and check if they are a seller
        $authenticated = auth()->user()->load('seller')->seller;
        $isSubscriber = $authenticated->isActiveSubscriber();

        // If the seller is an active subscriber, allow them to proceed
        if ($isSubscriber) {
            return $next($request);
        }

        // If the seller is not an active subscriber, return an error message
        return response([
            'message' => 'Unauthorized access for unsubscribing sellers'
        ], 403);
    }
}
