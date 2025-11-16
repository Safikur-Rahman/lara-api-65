<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/test',function () {
    return 'Laravel API Working';
});

// Route::apiresource('/status',App\Http\Controllers\Api\StatusController::class);
Route::apiresource('/roles',RoleController::class);
// Route::apiresource('/posts',PostController::class);
Route::POST('/register',[ApiController::class, 'register']);
Route::POST('/login',[ApiController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiresource('/posts',PostController::class);
    Route::POST('/logout',[ApiController::class, 'logout']);
});