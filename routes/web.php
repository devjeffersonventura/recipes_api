<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/recipes.php';
    require __DIR__ . '/users.php';
});
