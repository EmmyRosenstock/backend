<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
 /**
 * @OA\Get(
 *     path="/api/me",
 *     summary="Obtém detalhes do usuário logado",
 *     tags={"User"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Detalhes do usuário",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", format="email", example="user@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autorizado"
 *     )
 * )
 */

    public function me(Request $request)
    {
        // Retornar detalhes do usuário logado
        return response()->json([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'user@example.com'
        ], 200);
    }

   /**
 * @OA\Put(
 *     path="/api/password",
 *     summary="Atualiza a senha do usuário",
 *     tags={"User"},
 *     security={{"bearerAuth":{}}},  // Protegido por autenticação
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"current_password", "new_password"},
 *             @OA\Property(property="current_password", type="string", format="password", example="oldpassword123"),
 *             @OA\Property(property="new_password", type="string", format="password", example="newpassword456")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Senha atualizada com sucesso"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Não autorizado"
 *     )
 * )
 */

    public function updatePassword(Request $request)
    {
        // Lógica de atualização da senha
        return response()->json([
            'message' => 'Senha atualizada com sucesso'
        ], 200);
    }
}
