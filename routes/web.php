<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\IncomeController as AdminIncome;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\OrderController as CustomerOrder;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminOrder::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrder::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrder::class, 'updateStatus'])->name('update-status');
        Route::patch('/{order}/payment', [AdminOrder::class, 'updatePayment'])->name('update-payment');
        Route::delete('/{order}', [AdminOrder::class, 'destroy'])->name('destroy');
    });

    Route::get('/income', [AdminIncome::class, 'index'])->name('income');
});

// Customer Routes
Route::prefix('customer')->name('customer.')->middleware(['auth', 'customer'])->group(function () {
    Route::get('/dashboard', [CustomerDashboard::class, 'index'])->name('dashboard');

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [CustomerOrder::class, 'index'])->name('index');
        Route::get('/create', [CustomerOrder::class, 'create'])->name('create');
        Route::post('/', [CustomerOrder::class, 'store'])->name('store');
        Route::get('/{order}', [CustomerOrder::class, 'show'])->name('show');
    });
});
