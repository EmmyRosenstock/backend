<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Registra um novo usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuário registrado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="JWT Token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição"
     *     )
     * )
     */
    public function register(Request $request)
    {
        // Lógica de registro
        return response()->json(['token' => 'JWT Token de Exemplo'], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Realiza o login do usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login bem-sucedido",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="JWT Token")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas"
     *     )
     * )
     */
    public function login(Request $request)
    {
        // Lógica de login
        return response()->json(['token' => 'JWT Token de Exemplo'], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Realiza o logout do usuário",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Logout bem-sucedido"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */
    public function logout()
    {
        // Lógica de logout
        return response()->json(['message' => 'Logout realizado com sucesso'], 200);
    }
}
