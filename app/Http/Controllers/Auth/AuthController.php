<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['authenticate']]);
    }

    public function authenticate(Request $request)
    {
        $creds = $request->only('email', 'password');
        $token = JWTAuth::attempt($creds);

        if (!$token) {
            return response()->json(['error' => 'E-mail e/ou senha inválidos!'], 401);
        }

        $user = Auth::user();

        return response()->json(['token' => $token, 'user' => $user]);
    }

    /**
     * Metodo 1 para recuperar usuário autenticado
     */
    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    /**
     * Metodo 2 para recuperar usuário autenticado
     * passar middleware de auth na rota
     */
    public function me()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['user_not_found'], 404);
        }

        return response()->json(['user' => $user]);
    }

    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        if (!$token) {
            return response()->json(['error' => 'token não enviado!'], 401);
        }

        try {
            $token = JWTAuth::refresh();
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        }

        return response()->json(['token' => $token]);
    }
}
