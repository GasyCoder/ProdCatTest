<?php

use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Routes API Admin (Authentification Sanctum + Admin uniquement)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    
    // API: Lister tous les produits (Admin uniquement)
    Route::get('/produits', [ApiProductController::class, 'index']);
    
});

/*
|--------------------------------------------------------------------------
| Routes API Produits (Authentification Sanctum + Admin uniquement)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    
    // API: Créer un produit (Admin uniquement)
    Route::post('/produits/create', [ApiProductController::class, 'store']);
    
});