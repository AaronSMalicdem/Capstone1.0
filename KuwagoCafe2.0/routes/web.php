<?php
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin Routes
Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('admin/menus', MenuController::class); // CRUD for Menus
    Route::get('admin/orders', [AdminController::class, 'orders']); // View all orders
});

// Cashier Routes
Route::middleware([RoleMiddleware::class . ':cashier'])->group(function () {
    Route::get('cashier/orders', [CashierController::class, 'orders']); // View orders
    Route::post('cashier/orders/{order}/update', [CashierController::class, 'updateStatus']); // Update order status
});

// Customer Routes
Route::middleware([RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('customer/menus', [CustomerController::class, 'viewMenu']); // View menu
    Route::post('menu/{menu}/order', [CustomerController::class, 'placeOrder']); // Place order
    Route::post('feedback', [CustomerController::class, 'submitFeedback']); // Submit feedback
});
