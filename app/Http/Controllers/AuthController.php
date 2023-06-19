<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Faz login e retorna as credenciais para uso da API",
     *     tags={"Autenticação"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={"email": "admin@mail.com", "password": "147258369"},
     *                 @OA\Property(
     *                     description="email",
     *                     property="email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     description="password",
     *                     property="password",
     *                     type="string",
     *                 ),
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/auth/me",
     *     summary="Retorna dados sobre o usuário logado",
     *     tags={"Autenticação"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Faz logout",
     *     tags={"Autenticação"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Post(
     *     path="/api/auth/refresh",
     *     summary="Atualiza as credenciais do usuário logado",
     *     tags={"Autenticação"},
     *     security={{"bearerAuth":{}}}, 
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Sem autenticação"
     *     )
     * )
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}