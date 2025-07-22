<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteCommentController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'signin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'signup'])->name('register.post');
});


Route::group(['middleware' => 'auth'], function () {
    // ========================= start Route Dashboard =============================
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');
    // ========================= End Route Dashboard =============================

    // ========================= start Route Notes =============================
    Route::get('/note', [NoteController::class, 'index'])->name('notes');
    Route::get('/note/{id}', [NoteController::class, 'show'])->name('notes.show');
    Route::post('/note', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/note/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::put('/note/{id}/private', [NoteController::class, 'changeStatus'])->name('note.private');
    Route::put('/note/{id}/public', [NoteController::class, 'changeStatus'])->name('note.public');
    Route::put('/note/{id}/shared', [NoteController::class, 'changeStatus'])->name('note.shared');
    Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
    // ========================= End Route Notes =============================


    // ========================= start Route NoteComments =============================
    Route::get('/note-comments', [NoteCommentController::class, 'index'])->name('note-comments');
    Route::get('/note-comments/{note_id}', [NoteCommentController::class, 'show'])->name('note-comments.show');
    Route::post('/note-comments', [NoteCommentController::class, 'store'])->name('note-comments.store');
    Route::put('/note-comments/{id}', [NoteCommentController::class, 'update'])->name('note-comments.update');
    Route::delete('/note-comments/{id}', [NoteCommentController::class, 'destroy'])->name('note-comments.destroy');
    // ========================= End Route NoteComments =============================

    // ========================= start Route Profile =============================
    Route::get('/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [AuthController::class, 'profileUpdate'])->name('profile.update');
    // ========================= End Route Profile =============================

    // ========================= start Route Logout =============================
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // ========================= End Route Logout =============================
});
