<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationTypeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProcessingWDController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\WorkToolsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CooperationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemFoundController;
use App\Http\Controllers\LocationDivisionController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\WorkReportController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsHrd;

// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));

// Public routes (accessible without login)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Public worktools routes
Route::get('/worktools/create', [WorkToolsController::class, 'create'])->name('worktools.create');
Route::post('/test-worktools', [WorkToolsController::class, 'store'])->name('worktools.store');
Route::get('test-worktools', [WorkToolsController::class, 'index'])->name('worktools.index');
Route::redirect('/worktools', '/test-worktools');

// Public location routes
Route::get('/test', [ProductController::class, 'test']);

Route::prefix('v1')->group(function () {
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('{id}', 'show');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'destroy');
    });
});

// Protected routes (only accessible if logged in)
Route::middleware([AuthMiddleware::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [LoginController::class, 'dashboard']);

    // Profile routes
    Route::get('/profile', fn() => view('profile'))->name('profile.edit');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'show'])->name('profileform');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // 🛡 Admin only routes
    Route::middleware([IsAdmin::class])->group(function () {
        // User management
        Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Admin resourcesF
        Route::resource('cooperations', CooperationController::class);
        Route::resource('funds', FundController::class);
 });

        // 🛡 HRD only routes
    Route::middleware([IsHrd::class])->group(function () {
        // Worktools (except create and store which are public)
        Route::get('/worktools/{id}/edit', [WorkToolsController::class, 'edit'])->name('worktools.edit');
        Route::put('/worktools/{id}', [WorkToolsController::class, 'update'])->name('worktools.update');
        Route::delete('/worktools/{id}', [WorkToolsController::class, 'destroy'])->name('worktools.destroy');

        Route::get('/location/pdf', [LocationController::class, 'downloadPDF'])->name('location.pdf');
        Route::resource('location', LocationController::class);
        Route::resource('location-type', LocationTypeController::class);

        // API routes
        // Location Division
        Route::prefix('location-divisions')->controller(LocationDivisionController::class)->name('location-division.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/petugas', 'indexPetugas')->name('index-petugas');
            Route::put('/update-status/{id}', 'updateStatus')->name('update-status');
        });

        // Employee Contract
        Route::prefix('employee-contracts')->controller(EmployeeContractController::class)->name('employee-contract.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

        // Processing WD
        Route::get('/processing_wd', [ProcessingWDController::class, 'index']);
        Route::get('/processing_wd/create', [ProcessingWDController::class, 'create'])->name('processing_wd.create');
    });
   




    
    // 📋 Routes accessible by all logged-in users
    // Attendances
    Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::get('/attendances/creates', [AttendanceController::class, 'creates'])->name('attendances.creates');
    Route::post('/attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy'])->name('attendances.destroy');
    Route::get('/employees-attendances', [AttendanceController::class, 'indexs'])->name('employees_attendances.index');
    Route::patch('/attendances/{id}/status', [AttendanceController::class, 'updateStatus'])->name('attendances.update-status');

    // Complaints
    Route::resource('complaints', ComplaintController::class);
    Route::get('/get-employee/{location}', [ComplaintController::class, 'getEmployeeByLocation']);
    Route::get('/get-employee-by-location/{locationId}', [ComplaintController::class, 'getEmployeeByLocation']);

    Route::prefix('workreports')->controller(WorkReportController::class)->group(function () {
        Route::get('/', 'index')->name('workreports.index');
        Route::get('/create', 'create')->name('workreports.create');
        Route::post('/', 'store')->name('workreports.store');
        Route::get('/{id}/edit', 'edit')->name('workreports.edit');
        Route::put('/{id}', 'update')->name('workreports.update');
        Route::delete('/{id}', 'destroy')->name('workreports.destroy');
    });

    Route::get('/lostitems', [LostItemController::class, 'index'])->name('lostitem.index');
    Route::get('/lostitems/create', [LostItemController::class, 'create'])->name('lostitem.create');
    Route::post('/lostitems', [LostItemController::class, 'store'])->name('lostitem.store');
    Route::get('/lostitems/{id}/edit', [LostItemController::class, 'edit'])->name('lostitem.edit');
    Route::put('/lostitems/{id}', [LostItemController::class, 'update'])->name('lostitem.update');
    Route::delete('/lostitems/{id}', [LostItemController::class, 'destroy'])->name('lostitem.destroy');

    Route::get('/itemfounds/create', [ItemFoundController::class, 'create'])->name('itemfound.create');
    Route::post('/itemfounds', [ItemFoundController::class, 'store'])->name('itemfound.store');
    Route::get('/itemfounds/{id}/edit', [ItemFoundController::class, 'edit'])->name('itemfound.edit');
    Route::put('/itemfounds/{id}', [ItemFoundController::class, 'update'])->name('itemfound.update');
    Route::delete('/itemfounds/{id}', [ItemFoundController::class, 'destroy'])->name('itemfound.destroy');

    Route::resource('employees', controller: EmployeeController::class);
});
