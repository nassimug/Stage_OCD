<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Controllers\DegreeController;

Route::get('/', function () {
    return view('layouts.app');
});


// Protéger l'accès avec middleware auth (authentification requise)
Route::middleware(['auth'])->group(function () {
    Route::get('/people', [PersonController::class, 'index'])->name('people.index');
    Route::get('/people/create', [PersonController::class, 'create'])->name('people.create');
    Route::post('/people', [PersonController::class, 'store'])->name('people.store');
    Route::get('/people/{id}', [PersonController::class, 'show'])->name('people.show');
});


// Routes pour la connexion et l'inscription
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::get('/degree-form', function () {
    return view('degree');
})->name('degree.form');
Route::get('/degree', [DegreeController::class, 'check'])->name('degree.check');

