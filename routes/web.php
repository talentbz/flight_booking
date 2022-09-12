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
Route::prefix('/admin')->middleware(['auth:web'])->group(function () {
    Route::group(['middleware' => 'Admin'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
        Route::get('/edit_profile', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.edit.profile');
        Route::post('/edit_profile', [App\Http\Controllers\Admin\AdminController::class, 'store'])->name('admin.store.profile');
        Route::get('/cache_clear', [App\Http\Controllers\Admin\AdminController::class, 'clear'])->name('admin.cache.clear');
        Route::prefix('/seat')->group(function () {
            Route::get('/edit', [App\Http\Controllers\Admin\SeatController::class, 'edit'])->name('admin.seat.edit');
            Route::post('/edit', [App\Http\Controllers\Admin\SeatController::class, 'store'])->name('admin.seat.store');
        });
        Route::prefix('/user')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
            Route::post('/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
            Route::get('/status', [App\Http\Controllers\Admin\UserController::class, 'status'])->name('admin.user.status');
            Route::post('/reset_password/{id}', [App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('admin.user.reset_password');
        });
        Route::prefix('/price')->group(function () {
            Route::get('/by_count', [App\Http\Controllers\Admin\PriceController::class, 'countIndex'])->name('admin.price.count_index');
            Route::get('/by_count_status', [App\Http\Controllers\Admin\PriceController::class, 'statusChange'])->name('admin.price.count_status');
            Route::post('/by_count_store', [App\Http\Controllers\Admin\PriceController::class, 'countStore'])->name('admin.price.count_store');
            Route::get('/by_date', [App\Http\Controllers\Admin\PriceController::class, 'dateIndex'])->name('admin.price.date_index');
            Route::post('/by_date_store', [App\Http\Controllers\Admin\PriceController::class, 'dateStore'])->name('admin.price.date_store');
            Route::get('/by_date_status', [App\Http\Controllers\Admin\PriceController::class, 'dateStatusChange'])->name('admin.price.date_status');
            Route::get('/baggage', [App\Http\Controllers\Admin\PriceController::class, 'baggageIndex'])->name('admin.price.baggage_index');
            Route::post('/baggage', [App\Http\Controllers\Admin\PriceController::class, 'baggageStore'])->name('admin.price.baggage_store');
        });
        Route::prefix('/schedule')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ScheduleController::class, 'index'])->name('admin.schedule.index');
            Route::get('/create', [App\Http\Controllers\Admin\ScheduleController::class, 'create'])->name('admin.schedule.create');
            Route::post('/store', [App\Http\Controllers\Admin\ScheduleController::class, 'store'])->name('admin.schedule.store');
            Route::get('/status', [App\Http\Controllers\Admin\ScheduleController::class, 'status'])->name('admin.schedule.status');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'edit'])->name('admin.schedule.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\ScheduleController::class, 'update'])->name('admin.schedule.update');
        });
        Route::prefix('/airline')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\AirlineController::class, 'index'])->name('admin.airline.index');
            Route::get('/create', [App\Http\Controllers\Admin\AirlineController::class, 'create'])->name('admin.airline.create');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\AirlineController::class, 'edit'])->name('admin.airline.edit');
            Route::post('/update/{id}', [App\Http\Controllers\Admin\AirlineController::class, 'update'])->name('admin.airline.update');
            Route::post('/store', [App\Http\Controllers\Admin\AirlineController::class, 'store'])->name('admin.airline.store');
            Route::get('/status', [App\Http\Controllers\Admin\AirlineController::class, 'status'])->name('admin.airline.status');
        });
        Route::prefix('/approve')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ApproveController::class, 'index'])->name('admin.approve.index');
            Route::get('/count', [App\Http\Controllers\Admin\ApproveController::class, 'count'])->name('admin.approve.count');
            Route::get('/status', [App\Http\Controllers\Admin\ApproveController::class, 'status'])->name('admin.approve.status');
        });
    });
    
    Route::prefix('/booking')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.booking.index');
        Route::get('/create', [App\Http\Controllers\Admin\BookingController::class, 'create'])->name('admin.booking.create');
        Route::post('/store', [App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.booking.store');
        Route::get('/seat_map', [App\Http\Controllers\Admin\BookingController::class, 'seatMap'])->name('admin.booking.seat_map');
        Route::get('/schedule', [App\Http\Controllers\Admin\BookingController::class, 'schedule'])->name('admin.booking.schedule');
        Route::post('/approve/store', [App\Http\Controllers\Admin\ApproveController::class, 'store'])->name('admin.booking.approve.store');
    });
});
