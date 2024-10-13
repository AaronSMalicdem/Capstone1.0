<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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