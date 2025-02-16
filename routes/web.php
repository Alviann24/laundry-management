<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaundryItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\LaundryController;

use App\Http\Controllers\Penjual\OrderController as PenjualOrderController;
use App\Http\Controllers\ProfileController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Redirect Berdasarkan Role
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'penjual') {
        return redirect()->route('penjual.dashboard');
    } elseif ($role === 'pembeli') {
        return redirect()->route('pembeli.dashboard');
    }

    abort(403, 'Unauthorized.');
})->middleware('auth')->name('dashboard');




// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User Management
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Laundry Management
    Route::resource('/laundry', LaundryItemController::class)->except(['edit', 'update']); // Mendefinisikan resource route tanpa edit & update
    Route::get('/laundry/create', [LaundryItemController::class, 'create'])->name('laundry.create'); // Pastikan route create ini ada
    Route::get('/laundry/{laundryItem}/edit', [LaundryItemController::class, 'edit'])->name('laundry.edit'); // Pastikan route edit ini ada|// Pastikan route update ini ada
    Route::put('/laundry/{laundryItem}', [LaundryItemController::class, 'update'])->name('laundry.update'); // Pastikan route edit ini ada|// Pastikan route update ini ada
    
    // Order Management
    Route::get('/orders', [AdminController::class, 'manageOrders'])->name('orders.index');
    Route::put('/orders/{order}', [AdminController::class, 'updateOrderStatus'])->name('orders.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});




// Penjual Routes
Route::middleware(['auth', 'role:penjual'])->prefix('penjual')->name('penjual.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PenjualOrderController::class, 'index'])->name('dashboard');

    // Order Management
    Route::post('/orders', [PenjualOrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/confirm', [PenjualOrderController::class, 'confirm'])->name('orders.confirm');
    Route::delete('/orders/{order}/cancel', [PenjualOrderController::class, 'cancelOrder'])->name('orders.cancel');
    
    // Detail Order
    Route::get('/orders/{order}', [PenjualOrderController::class, 'show'])->name('orders.show');
});




// Pembeli Routes
use App\Http\Controllers\Pembeli\DashboardController;

Route::middleware(['auth', 'role:pembeli'])->prefix('pembeli')->name('pembeli.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});




// Otentikasi
Auth::routes();

// Profile Routes
Route::middleware(['auth'])->group(function () {
    // Admin Profile Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/profile', [ProfileController::class, 'show'])->name('admin.profile');
        Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    });

    // Penjual Profile Routes
    Route::middleware(['role:penjual'])->group(function () {
        Route::get('/penjual/profile', [ProfileController::class, 'show'])->name('penjual.profile');
        Route::get('/penjual/profile/edit', [ProfileController::class, 'edit'])->name('penjual.profile.edit');
        Route::put('/penjual/profile', [ProfileController::class, 'update'])->name('penjual.profile.update');
    });

    // Pembeli Profile Routes
    Route::middleware(['role:pembeli'])->group(function () {
        Route::get('/pembeli/profile', [ProfileController::class, 'show'])->name('pembeli.profile');
        Route::get('/pembeli/profile/edit', [ProfileController::class, 'edit'])->name('pembeli.profile.edit');
        Route::put('/pembeli/profile', [ProfileController::class, 'update'])->name('pembeli.profile.update');
    });
});


use App\Http\Controllers\InvoiceController;

Route::get('/invoice/{orderId}', [InvoiceController::class, 'generateInvoice'])->name('invoice.download');
