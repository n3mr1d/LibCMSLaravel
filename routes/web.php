<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;
// welcome user
Route::view('/', 'welcome.home')->name('home');
Route::view('about', 'welcome.about')->name('about');
Route::view('contact', 'welcome.contact')->name('contact');

// guest acces {login,regiester,reset-password, forget password}
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
