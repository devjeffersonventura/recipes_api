<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

// Rotas acessíveis sem autenticação
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{$id}', [RecipeController::class, 'show']);

// Rotas protegidas por autenticação, exceto 'index' e 'show'
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('recipes', RecipeController::class)->except(['index', 'show']);
});