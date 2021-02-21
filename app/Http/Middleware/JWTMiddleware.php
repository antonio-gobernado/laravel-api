<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $message='';

        try{

            //chequear validacion de token

            JWTAuth::parseToken()->authenticate();
            return $next($request);

        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){

            //token expirado

            $message='token expirado';

        }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){

            //token invalido

            $message='token invalido';

        }catch (\Tymon\JWTAuth\Exceptions\JWTException $e){

            // cuando no se presenta el token

            $message='esperando token';
        }


        return response()->json([

            'success' => false,
            'message' => $message

        ]);

    }
}
