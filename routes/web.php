<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\StudentRegistration;

Route::view('/', 'welcome')->name('welcome');

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

require __DIR__.'/auth.php';
