<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Livewire\Dashboard\Dashboard;
use App\Http\Livewire\Dashboard\Maintenance;
use App\Http\Livewire\Dashboard\Users;
use Illuminate\Support\Facades\Route;

Route::name('web.')->middleware(['throttle:1000,60'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['throttle:1000,60', 'auth'])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/users', Users::class)->name('users');
    Route::get('/maintenance', Maintenance::class)->name('maintenance');
});


require __DIR__.'/auth.php';
