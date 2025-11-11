<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Laravel\json;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(!Auth::check()){
            if($request->expectsJson() || $request->has('api/*')){
                return response()->json([
                    "message" => "Unauthorize"
                ],401);
            }
            Log::warning('Url bypass',[
                "ip"=>$request->ip(),
            ]);

            return redirect()->route('login');
        }

        $roles = Auth::user()->role ??null;

        $hasAccess = in_array($roles,['staff', 'admin'],true);

        if(!$hasAccess){
              if($request->expectsJson() || $request->has('api/*')){
                return response()->json([
                    "message" => "Unauthorize"
                ],401);
            }
            Log::warning('Url bypass',[
                "ip"=>$request->ip(),
            ]);

            return redirect()->route('login');
        }
       
        return $next($request);
    }
}
