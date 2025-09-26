<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\AdminDetailController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminUseridController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\AdminRequestidController;

Route::prefix('/')->group(function(){
    Route::get('/', [RegisterController::class, 'create'])->name('home');
    Route::get('/register',[RegisterController::class,'create'])->name('register.create');
    Route::post('/register',[RegisterController::class,'store'])->name('register');

    Route::get('/login',[LoginController::class,'showLoginForm'])->name('login.show');
    Route::post('/login',[LoginController::class,'login'])->name('login');

    Route::middleware('auth')->group(function(){
        Route::get('/attendances',[AttendanceController::class,'index'])->name('attendances.index');
        Route::post('/attendances',[AttendanceController::class,'store'])->name('attendances.store');
        Route::post('/attendances/clock-in',[AttendanceController::class,'clockIn'])->name('clock.in');
        Route::post('/attendances/clock-out',[AttendanceController::class,'clockOut'])->name('clock.out');
        Route::post('/attendances/break-start',[AttendanceController::class,'startBreak'])->name('break.start');
        Route::post('/attendances/break-end',[AttendanceController::class,'endBreak'])->name('break.end');

        Route::get('/attendances/list',[AttendanceController::class,'list'])->name('user.attendance.list');

        Route::get('/attendances/detail/{id}',[DetailController::class,'show'])->name('user.attendance.show');
        Route::post('/attendances/update/{id}',[DetailController::class,'update'])->name('user.attendance.update');

        Route::get('/stamp_correction_request/list',[RequestController::class,'index'])->name('requests.index');
        Route::get('/stamp_correction_request/{id}',[RequestController::class,'show'])->name('requests.show');
        Route::post('/stamp_correction_request/store',[RequestController::class,'store'])->name('requests.store');
    });
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('login',[AdminLoginController::class,'showLoginForm'])->name('login.show');
    Route::post('login',[AdminLoginController::class,'login'])->name('login');
    Route::post('logout',[AdminLoginController::class,'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function(){
        Route::get('/attendances',[AdminListController::class,'index'])->name('list');

        Route::get('/attendances/{id}',[AdminDetailController::class,'show'])->name('detail');
        Route::put('/attendances/{id}',[AdminDetailController::class,'update'])->name('detail.update');

        Route::get('/users',[AdminUserController::class,'index'])->name('users.index');
        Route::get('/users/{user}/attendances',[AdminUseridController::class,'index'])->name('users.attendances.index');

        Route::get('/requests',[AdminRequestController::class,'index'])->name('requests.index');
        Route::put('/requests/{id}',[AdminRequestidController::class,'update'])->name('requests.update');
    });
});
