<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\AnnouncementController;
use App\Http\Controllers\dashboard\DepartmanController;
use App\Http\Controllers\dashboard\IndexController;
use App\Http\Controllers\dashboard\MaadiranController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\dashboard\SupervisorController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\VamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/auth/login');

Route::prefix('/auth')->middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'index'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


Route::prefix('/dashboard')->middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {

        Route::resource('departman', DepartmanController::class);
        Route::resource('supervisor', SupervisorController::class);
    });

    Route::middleware('role:author|manager1|admin|humanResources|manager2|subscriber')->group(function () {

        // Dashboard home
        Route::get('/', [IndexController::class, 'index'])->name('index');

        Route::resource('users', UserController::class);
        Route::resource('service', ServiceController::class);
        Route::resource('vam', VamController::class);
        Route::resource('maadiran', MaadiranController::class);
        Route::resource('announcement', AnnouncementController::class);

        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::middleware('role:author')->group(function () {

        Route::get('vams', [SupervisorController::class, 'vamRequestsForSupervisor'])->name('supervisor.vam.index');
        Route::get('vams/{vam}/edit', [SupervisorController::class, 'editVam'])->name('supervisor.vam.edit');
        Route::put('vams/{vam}', [SupervisorController::class, 'updateVam'])->name('supervisor.vam.update');

        Route::get('services', [SupervisorController::class, 'serviceRequestsForSupervisor'])->name('supervisor.service.index');
        Route::get('services/{service}/edit', [SupervisorController::class, 'editService'])->name('supervisor.service.edit');
        Route::put('services/{service}', [SupervisorController::class, 'updateService'])->name('supervisor.service.update');

        Route::get('maadirans', [SupervisorController::class, 'maadiranRequestsForSupervisor'])->name('supervisor.maadiran.index');
        Route::get('maadirans/{maadiran}/edit', [SupervisorController::class, 'editMaadiran'])->name('supervisor.maadiran.edit');
        Route::put('maadirans/{maadiran}', [SupervisorController::class, 'updateMaadiran'])->name('supervisor.maadiran.update');
    });
});
