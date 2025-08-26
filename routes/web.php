<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Livewire\Basket;
use App\Livewire\MedicineSearch;
use App\Livewire\SparepartSearch;
// use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::post("/login-employee", [HomeController::class, 'loginEmployee'])->name('login.employee');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('employee')->group(function () {
    Route::get('/home-employee', [HomeController::class, 'home_employee'])->name('home-employee');

    Route::get('/basket', [TransactionController::class, 'basket'])->name('basket');
    Route::get('/search', MedicineSearch::class)->name('search.index');
    Route::get('/cart', Basket::class)->name('basket.index');
});


Route::middleware('admin')->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Route::get('/home-admin', [HomeController::class, 'index'])->name('home');

    // Medicine
    Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine');
    Route::prefix('medicine')->name("medicine.")->group(function () {
        Route::get('/create', [MedicineController::class, 'create'])->name('create');
        Route::get('/update/{id}', [MedicineController::class, 'update'])->name('update');
        Route::post('/store', [MedicineController::class, 'store'])->name('store');
        Route::put('/set/{id}', [MedicineController::class, 'set'])->name('set');
        Route::delete('/delete/{id}', [MedicineController::class, 'delete'])->name('delete');
    });

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('stock');
    Route::prefix('stock')->name("stock.")->group(function () {
        Route::get('/manage', [MedicineController::class, 'stock'])->name('manastock');
        Route::post('/create', [StockController::class, 'addNewBatch'])->name('create');
        Route::post('/update', [StockController::class, 'updateBatch'])->name('update');
        Route::delete('/delete/{id}', [StockController::class, 'delete'])->name('delete');
    });

    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
    Route::prefix('employee')->name("employee.")->group(function () {
        Route::get('/create', [EmployeeController::class, 'create'])->name('create');
        Route::get('/update/{id}', [EmployeeController::class, 'update'])->name('update');
        Route::post('/store', [EmployeeController::class, 'store'])->name('store');
        Route::put('/set/{id}', [EmployeeController::class, 'set'])->name('set');
        Route::delete('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
        Route::get('/change-status/{id}', [EmployeeController::class, 'setStatus'])->name('status');
        Route::get('/default-password/{id}', [EmployeeController::class, 'setDefaultPassword'])->name('defaultpass');
    });

    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::prefix('inventory')->name("inventory.")->group(function () {
        Route::get('/create', [InventoryController::class, 'create'])->name('create');
        Route::get('/generatePdf/{from}/{to}', [InventoryController::class, 'generatePdf'])->name('generatePdf');
        Route::get('/print/{from}/{to}', [InventoryController::class, 'print'])->name('print');
    });

    // Basket
    // Route::get('/basket', [SparepartController::class, 'basket'])->name('basket');

    //Transaction
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction');


    //History
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::prefix('history')->group(function () {
        Route::get('/create', [HistoryController::class, 'create'])->name('history.create');
        Route::get('/generatePdf/{from}/{to}', [HistoryController::class, 'generatePdf'])->name('history.generatePdf');
        Route::get('/print/{from}/{to}', [HistoryController::class, 'print'])->name('history.print');
    });


    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Livewire
    // Route::get('/search', SparepartSearch::class)->name('search.index');
    // Route::get('/cart', Basket::class)->name('basket.index');
});


require __DIR__ . '/auth.php';
