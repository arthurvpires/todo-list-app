<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/task/create', [TaskController::class, 'create']);
Route::get('/task/list', [TaskController::class, 'list']);
Route::post('/task/list/{id}', [TaskController::class, 'listDetails']);
Route::put('/task/update/{id}', [TaskController::class, 'update']);
Route::delete('/task/destroy/{id}', [TaskController::class, 'destroy']);
