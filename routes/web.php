<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\StudentRegistration;

Route::view('/', 'welcome');

Route::get('/welcome', function(){
    return view('welcome');
    })->name('welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('student-registration', StudentRegistration::class)
    ->middleware(['auth'])
    ->name('profile');

Route::get('/register-student', function(){
    return view('register-student');
    })->name('register-student');

Route::get('/login-admin', function(){
    return view('login-admin');
    })->name('login-admin');

Route::get('/register-admin', function(){
    return view('register-admin');
    })->name('register-admin');

Route::get('/manage-logs', function(){
    return view('manage-logs');
    })->middleware(['auth', 'verified'])->name('manage-logs');

Route::get('/manage-users', function(){
    return view('manage-users');
    })->middleware(['auth', 'verified'])->name('manage-users');

Route::get('/user-details/{user}', function ($user) {
    return view('user-details', ['userId' => $user]);
})->middleware(['auth', 'verified'])->name('user-details');

Route::get('/manage-venue', function(){
    return view('manage-venue');
    })->middleware(['auth', 'verified'])->name('manage-venue');

require __DIR__.'/auth.php';
