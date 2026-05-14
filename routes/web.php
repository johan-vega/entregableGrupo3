<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardManagementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::post('/dashboard/cites', [DashboardManagementController::class, 'storeCite'])->name('dashboard.cites.store');
    Route::put('/dashboard/cites/{cite}', [DashboardManagementController::class, 'updateCite'])->name('dashboard.cites.update');
    Route::delete('/dashboard/cites/{cite}', [DashboardManagementController::class, 'destroyCite'])->name('dashboard.cites.destroy');

    Route::post('/dashboard/pacients', [DashboardManagementController::class, 'storePacient'])->name('dashboard.pacients.store');

    Route::post('/dashboard/treatments', [DashboardManagementController::class, 'storeTreatment'])->name('dashboard.treatments.store');
    Route::put('/dashboard/treatments/{treatment}', [DashboardManagementController::class, 'updateTreatment'])->name('dashboard.treatments.update');
    Route::delete('/dashboard/treatments/{treatment}', [DashboardManagementController::class, 'destroyTreatment'])->name('dashboard.treatments.destroy');

    Route::post('/dashboard/medics', [DashboardManagementController::class, 'storeMedic'])->name('dashboard.medics.store');
});
