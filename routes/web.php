<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\IncomeController as AdminIncome;
use App\Http\Controllers\Admin\ChatController as AdminChat;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboard;
use App\Http\Controllers\Customer\OrderController as CustomerOrder;
use App\Http\Controllers\Customer\ChatController as CustomerChat;
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

    // Admin Live Chat
    Route::prefix('chats')->name('chats.')->group(function () {
        Route::get('/', [AdminChat::class, 'index'])->name('index');
        Route::get('/conversations', [AdminChat::class, 'conversations'])->name('conversations');
        Route::get('/unread-total', [AdminChat::class, 'unread-total'])->name('unread-total');
        Route::get('/{customer}/messages', [AdminChat::class, 'fetch'])->name('fetch');
        Route::post('/{customer}/messages', [AdminChat::class, 'send'])->name('send');
    });
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

    // Customer Live Chat
    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [CustomerChat::class, 'index'])->name('index');
        Route::get('/messages', [CustomerChat::class, 'fetch'])->name('fetch');
        Route::post('/messages', [CustomerChat::class, 'send'])->name('send');
        Route::get('/unread-count', [CustomerChat::class, 'unreadCount'])->name('unread-count');
    });
});
