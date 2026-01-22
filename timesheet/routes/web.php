<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return redirect('/my-timesheets');
});

Route::get('/timesheets', [TimesheetController::class, 'index']);
Route::get('/my-timesheets', [TimesheetController::class, 'myTimesheets'])->middleware('auth');
Route::get('/timesheets/create', [TimesheetController::class, 'create']);
Route::post('/timesheets', [TimesheetController::class, 'store'])->middleware('auth');
Route::get('/timesheets/{timesheet}', [TimesheetController::class, 'show']);
Route::get('/timesheets/{timesheet}/edit', [TimesheetController::class, 'edit'])->middleware('auth')->can('edit', 'timesheet');
Route::patch('/timesheets/{timesheet}', [TimesheetController::class, 'update']);
Route::delete('/timesheets/{timesheet}', [TimesheetController::class, 'destroy']);

// Auth
Route::get('register', [RegisteredUserController::class, 'create']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);
