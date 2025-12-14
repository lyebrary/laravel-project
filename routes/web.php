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

require __DIR__.'/auth.php';
