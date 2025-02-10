<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Obter usuário autenticado
    Route::get('/user', function (\Illuminate\Http\Request $request) {
        return response()->json($request->user());
    });
});
