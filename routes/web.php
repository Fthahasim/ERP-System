<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::any('/', [AuthController::class,'login'])->name('login');
Route::any('/register', [AuthController::class,'register'])->name('register');

Route::any('/signup', [AuthController::class,'signup'])->name('admin.register');
Route::any('/authenticate', [AuthController::class,'authenticate'])->name('admin.login');


Route::middleware(['auth'])->group(function () {

    Route::any('/logout', [AuthController::class,'logout'])->name('admin.logout');
    Route::any('/dashboard', [DashboardController::class,'dashboard'])->name('dashboard');

    Route::prefix('designation')->group(function () {
        Route::GET('/', [DesignationController::class, 'index'])->name('designation.index');
        Route::POST('/store', [DesignationController::class, 'store'])->name('designation.store');
        Route::GET('/get-dataTable', [DesignationController::class, 'getDataTable'])->name('designation.getData');
        Route::any('/edit/{designation}', [DesignationController::class, 'show'])->name('designation.show');
        Route::any('/update', [DesignationController::class, 'update'])->name('designation.update');
    });

    Route::prefix('user')->group(function () {
        Route::GET('/', [UserController::class, 'index'])->name('user.index');
        Route::POST('/store', [UserController::class, 'store'])->name('user.store');
        Route::GET('/get-dataTable', [UserController::class, 'getDataTable'])->name('user.getData');
        Route::any('/edit/{user}', [UserController::class, 'show'])->name('user.show');
        Route::any('/update', [UserController::class, 'update'])->name('user.update');
    });

});