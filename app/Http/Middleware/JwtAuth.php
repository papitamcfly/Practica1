<?php

namespace App\Http\Middleware;

use App\Mail\CodigoVerificacion;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = FacadesJWTAuth::parseToken()->authenticate();
            if($user->active === 0){
                $code = $user->code;
                Mail::to($request->email)->send(new CodigoVerificacion($code));
                return redirect()->route('')->withError(['message' => 'Acceso no autorizado.']);
            }
            else{
                return $next($request);
            }
        } catch (\Exception $e) {
            return redirect()->route('verifiycode')->withErrors(['message' => 'Acceso no autorizado.']);
        }

        return $next($request);
    }
}
