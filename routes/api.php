<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('post', [PostController::class, 'index'])->middleware('auth:api', 'verified');
Route::get('post/{id}', [PostController::class, 'show'])->middleware('auth:api', 'verified');
Route::post('comment/{id}', [CommentController::class, 'createApi'])->middleware('auth:api', 'verified');
// Route::get('users', [UserControllerApi::class, 'index'])->name('users.index')->middleware('role:superadmin');

Route::post('post', [PostController::class, 'create'])->middleware('auth:api','role:admin|superadmin', 'verified');

Route::middleware('auth:api', 'role:admin|superadmin', 'verified', 'authorize')->group(function () {
    Route::put('post/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'delete']);
});
// Route::put('update/role/{id}', [RoleControllerApi::class, 'updateRole'])->name('update.role')->middleware('role:superadmin');


//auth routes
Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
