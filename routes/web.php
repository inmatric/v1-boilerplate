<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationTypeController;

use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProcessingWDController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CooperationController;
use App\Http\Controllers\LocationDivisionController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/test', [ProductController::class, 'test']);
Route::get('/processing_wd', [ProcessingWDController::class, 'index']);
Route::get('/processing_wd/create', [ProcessingWDController::class, 'create'])->name('processing_wd.create');


Route::get('/location/pdf', [LocationController::class, 'downloadPDF'])->name('location.pdf');
Route::resource('location', LocationController::class);
Route::resource('location-type', LocationTypeController::class);

Route::prefix('v1')->group(function () {
    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index');           // GET /api/v1/products
        Route::post('/', 'store');          // POST /api/v1/products
        Route::get('{id}', 'show');         // GET /api/v1/products/{id}
        Route::put('{id}', 'update');       // PUT /api/v1/products/{id}
        Route::delete('{id}', 'destroy');   // DELETE /api/v1/products/{id}
    });
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'show'])->name('profileform');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
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

