<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserExists;

Route::get('/', function () {
    return view('root');
})->name('view.home');


Route::middleware('auth.redirect')->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('view.login');
    Route::get('/register', [AuthController::class, 'register'])->name('view.register');

    Route::post('/login', [AuthController::class, 'handleLogin'])->name('process.login');
    Route::post('/register', [AuthController::class, 'handleRegister'])->middleware(EnsureUserExists::class)->name('process.register');
});


Route::prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'handleLogout'])->middleware('auth')->name('process.logout');
});


Route::middleware('auth.isAuthenticated')->prefix('friends')->group(function () {
    Route::get('/', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/search', [FriendController::class, 'search'])->name('friends.search');
    Route::post('/create', [FriendController::class, 'create'])->name('friends.create');
    Route::delete('/delete/{id}', [FriendController::class, 'destroy'])->name('friends.delete');


    Route::get('/request', [FriendRequestController::class, 'index'])->name('friendRequest.index');
    Route::get('/request/received', [FriendRequestController::class, 'received'])->name('friendRequest.received');
    Route::post('/request', [FriendRequestController::class, 'create'])->name('friendRequest.create');
    Route::delete('/request/{id}', [FriendRequestController::class, 'destroy'])->name('friendRequest.delete');

});


Route::middleware('auth.isAuthenticated')->prefix('users')->group(function () {
    Route::get('/show/{id}', [UserController::class, 'show'])->name('view.user.show');
});


Route::middleware('auth.isAuthenticated')->prefix('conversations')->group(function () {
    Route::get('/show/{user_id}', [ConversationController::class, 'show'])->name('view.conversations.show');
});
