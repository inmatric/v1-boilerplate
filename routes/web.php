<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationTypeController;
use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProcessingWDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkToolsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CooperationController;
use App\Http\Controllers\LocationDivisionController;
use App\Http\Middleware\AuthMiddleware;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Public route (bisa diakses tanpa login)
Route::get('/worktools/create', [WorkToolsController::class, 'create'])->name('worktools.create');
Route::post('/test-worktools', [WorkToolsController::class, 'store'])->name('worktools.store');



// List worktools (opsional, bisa dijadikan public)
Route::get('test-worktools', [WorkToolsController::class, 'index'])->name('worktools.index');
Route::redirect('/worktools', '/test-worktools');

Route::get('/worktools/{id}/edit', [WorkToolsController::class, 'edit'])->name('worktools.edit');
Route::put('/worktools/{id}', [WorkToolsController::class, 'update'])->name('worktools.update');
Route::delete('/worktools/{id}', [WorkToolsController::class, 'destroy'])->name('worktools.destroy');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Public routes lainnya
Route::get('/test', [ProductController::class, 'test']);
Route::get('/location/pdf', [LocationController::class, 'downloadPDF'])->name('location.pdf');
Route::resource('location', LocationController::class);
Route::resource('location-type', LocationTypeController::class);


Route::prefix('v1')->group(function () {
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('{id}', 'show');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'destroy');
    });
});

// Protected routes (hanya bisa diakses jika sudah login)
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/profile', fn() => view('profile'))->name('profile');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'show'])->name('profileform');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('worktools', WorkToolsController::class)->except(['create', 'store']);

    Route::prefix('location-division')->controller(LocationDivisionController::class)->name('location-division.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });


    Route::prefix('employee-contract')->controller(EmployeeContractController::class)->name('employee-contract.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::get('/processing_wd', [ProcessingWDController::class, 'index']);
    Route::get('/processing_wd/create', [ProcessingWDController::class, 'create'])->name('processing_wd.create');
});


    Route::resource('cooperations', CooperationController::class);

    Route::prefix('employee-contract')->controller(EmployeeContractController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/edit', 'edit');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });

    Route::prefix('location-division')->controller(LocationDivisionController::class)->name('location-division.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');

        // Ini route untuk petugas (sudah benar)
        Route::get('/petugas', 'indexPetugas')->name('index-petugas');
    });
});


