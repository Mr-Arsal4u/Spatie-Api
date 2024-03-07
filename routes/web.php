<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/roleUsers', function () {
//     $users = User::Role('viewer')->get();
//     return $users;
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('post.index');
    Route::get('post/show/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/comment/{id}', [CommentController::class, 'create'])->name('comment.create');
});
Route::middleware(['role:superadmin|admin', 'authorize'])->prefix('post')->group(function () {
    Route::get('edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
});
Route::middleware(['role:superadmin|admin'])->prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::get('own-post', [PostController::class, 'ownPost'])->name('own.posts');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
});
Route::middleware(['role:superadmin'])->group(function () {
    Route::put('update-role/{id}', [RoleController::class, 'updateRole'])->name('update.role');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('roles', [RoleController::class, 'role_permissions'])->name('roles.index');
    Route::get('create-users', [UserController::class, 'usercreate'])->name('create.users');
    Route::post('save-user', [UserController::class, 'store'])->name('store.users');
    Route::post('save-permission', [RoleController::class, 'save_permissions'])->name('save.permissions');
});


Auth::routes(['verify' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
