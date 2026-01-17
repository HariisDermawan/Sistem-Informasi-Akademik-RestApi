<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'meta' => ['code'=>401,'status'=>'error','message'=>'Unauthenticated'],
                'data'=>null
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'meta' => ['code'=>403,'status'=>'error','message'=>'Hanya admin yang bisa mengakses'],
                'data'=>null
            ], 403);
        }

        return $next($request);
    }
}
