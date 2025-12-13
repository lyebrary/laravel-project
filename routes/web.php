<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\StudentRegistration;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('student-registration', StudentRegistration::class)
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
