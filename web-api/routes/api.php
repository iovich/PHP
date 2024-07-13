<?php

use App\Http\Controllers\Api\CategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoriesController::class, 'getList']);
Route::post('/categories/create', [CategoriesController::class, 'create']);
Route::get('/categories/{id}', [CategoriesController::class, 'getById']);
Route::put('/categories/{id}/update', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}/delete', [CategoriesController::class, 'delete']);
