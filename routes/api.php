<?php

use Illuminate\Support\Facades\Route;

// Rotas da API de receitas
Route::prefix('v1')->group(function () {
    require __DIR__ . '/recipes.php';
    require __DIR__ . '/users.php';
});
