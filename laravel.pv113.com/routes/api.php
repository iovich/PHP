<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\SenderController;
use \App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoriesController::class, 'getList']);
Route::get('/categories/{id}', [CategoriesController::class, 'getById']);
Route::post('/categories/create', [CategoriesController::class, 'create'])->middleware('auth:api');
Route::delete("/categories/{id}", [CategoriesController::class, "delete"]);
Route::post("/categories/edit/{id}", [CategoriesController::class, "edit"])->middleware('auth:api');

Route::post('/send/email', [SenderController::class, 'send_email']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/google', [AuthController::class, 'loginGoogle']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verification', [AuthController::class, 'verificationEmail']);
