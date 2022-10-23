<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;


// Route::get("/category", [CategoryController::class, 'index']);
// Route::get("/category/{id}", [CategoryController::class, 'show']);
// Route::post("/category", [CategoryController::class, 'store']);
// Route::put("/category/{id}", [CategoryController::class, 'update']);
// Route::delete("/category/{id}", [CategoryController::class, 'destroy']);

Route::prefix('v1')->group(function () {
    Route::get('categories/{id}/products', [CategoryController::class, 'products']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});

Route::post('/auth', [AuthController::class, 'authenticate']);
Route::post('/auth-refresh', [AuthController::class, 'refreshToken']);
Route::get('/user', [AuthController::class, 'getAuthenticatedUser']);

Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');


// Route::get('/unauthenticated', function () {
//     return response()->json(['error' => 'Usuário não atenticado.'], 401);
// })->name('login');
