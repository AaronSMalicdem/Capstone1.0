<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ExpensesReportController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    
    // Admin dashboard route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->middleware('role:admin');

    // Kuwago dashboard route
    Route::get('/kuwago/dashboard', function () {
        return view('kuwago.dashboard');
    })->middleware('role:kuwago_manager,admin,finance_officer'); // Allow admin and finance to access

    // Uddesign dashboard route
    Route::get('/uddesign/dashboard', function () {
        return view('uddesign.dashboard');
    })->middleware('role:uddesign_manager,admin,finance_officer'); // Allow admin and finance to access

    // Finance dashboard route
    Route::get('/finance/dashboard', function () {
        return view('finance.dashboard');
    })->middleware('role:finance_officer');

});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index')->middleware('role:admin');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create')->middleware('role:admin');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store')->middleware('role:admin');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit')->middleware('role:admin');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update')->middleware('role:admin');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('role:admin');

});
Route::match(['get', 'post'], '/expenses-report', [ExpensesReportController::class, 'index'])->name('expenses-report');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
