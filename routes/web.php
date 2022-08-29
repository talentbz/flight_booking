<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('home');

//admin section
Route::prefix('/admin')->middleware(['auth:web', 'Admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
    Route::get('/edit_profile', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.edit.profile');
    Route::post('/edit_profile', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.store.profile');
    Route::prefix('/user')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    });
    Route::prefix('/seat')->group(function () {
        Route::get('/edit', [App\Http\Controllers\Admin\SeatController::class, 'edit'])->name('admin.seat.edit');
        Route::post('/edit', [App\Http\Controllers\Admin\SeatController::class, 'store'])->name('admin.seat.store');
    });
    Route::prefix('/price')->group(function () {
        Route::get('/by_count', [App\Http\Controllers\Admin\PriceController::class, 'countIndex'])->name('admin.price.count_index');
        Route::get('/by_count_status', [App\Http\Controllers\Admin\PriceController::class, 'statusChange'])->name('admin.price.count_status');
        Route::post('/by_count_store', [App\Http\Controllers\Admin\PriceController::class, 'countStore'])->name('admin.price.count_store');
        Route::get('/by_date', [App\Http\Controllers\Admin\PriceController::class, 'dateIndex'])->name('admin.price.date_index');
        Route::post('/by_date_store', [App\Http\Controllers\Admin\PriceController::class, 'dateStore'])->name('admin.price.date_store');
        Route::get('/by_date_status', [App\Http\Controllers\Admin\PriceController::class, 'dateStatusChange'])->name('admin.price.date_status');
    });
    Route::prefix('/schedule')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('admin.schedule.index');
        Route::get('/create', [App\Http\Controllers\Admin\ScheduleController::class, 'create'])->name('admin.schedule.create');
        Route::post('/store', [App\Http\Controllers\Admin\ScheduleController::class, 'store'])->name('admin.schedule.store');
        Route::get('/status', [App\Http\Controllers\Admin\ScheduleController::class, 'status'])->name('admin.schedule.status');
        Route::get('/edit/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'edit'])->name('admin.schedule.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'update'])->name('admin.schedule.update');
    });
    Route::prefix('/booking')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.booking.index');
    });
});
