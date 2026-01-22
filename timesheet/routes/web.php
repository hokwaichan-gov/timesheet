<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('/my-timesheets');
});

Route::get('/timesheets', [TimesheetController::class, 'index'])->middleware('admin');
Route::get('/my-timesheets', [TimesheetController::class, 'myTimesheets'])->middleware('auth');
Route::get('/timesheets/create', [TimesheetController::class, 'create']);
Route::get('/timesheets/create-week', [TimesheetController::class, 'createWeek']);
Route::post('/timesheets', [TimesheetController::class, 'store'])->middleware('auth');
Route::post('/timesheets/create-week', [TimesheetController::class, 'storeWeek'])->middleware('auth');
Route::get('/timesheets/{timesheet}', [TimesheetController::class, 'show']);
Route::get('/timesheets/{timesheet}/edit', [TimesheetController::class, 'edit'])->middleware('auth')->can('edit', 'timesheet');
Route::patch('/timesheets/{timesheet}', [TimesheetController::class, 'update']);
Route::patch('/timesheets/{timesheet}/sup-initial', [TimesheetController::class, 'updateSupInitial']);
Route::delete('/timesheets/{timesheet}', [TimesheetController::class, 'destroy']);

// Auth
Route::get('register', [RegisteredUserController::class, 'create']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/timesheets', [AdminController::class, 'timesheets'])->name('admin.timesheets');
});
