<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\json;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(["message" => "Unauthorized"], 401);
            }
            Log::warning('URL bypass', ["ip" => $request->ip()]);
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? null;

        if (!in_array($userRole, $roles, true)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(["message" => "Forbidden"], 403);
            }
            Log::warning('Role restricted access', [
                "ip" => $request->ip(),
                "role" => $userRole,
                "required_roles" => $roles,
            ]);
            return redirect()->route('login');
        }

        return $next($request);
    }
}
