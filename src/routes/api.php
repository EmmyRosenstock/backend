<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']); // Rota de registro
Route::post('/login', [AuthController::class, 'login']); // Rota de login
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api'); // Rota de logout (precisa de autenticação)
Route::get('/me', [UserController::class, 'me'])->middleware('auth:api'); // Obter detalhes do usuário logado
Route::put('/password', [UserController::class, 'updatePassword'])->middleware('auth:api'); // Atualizar senha


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
