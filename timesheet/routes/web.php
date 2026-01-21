<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\LoginController;

Route::view('/', 'home');

//Resource Methods
Route::resource('timesheets', TimesheetController::class);

// Route::controller(TimesheetController::class)->group(function () {
//     Route::get('/timesheets', 'index');
//     Route::get('/timesheets/create', 'create');
//     Route::get('/timesheets/{timesheet}', 'show');
//     Route::post('/timesheets', 'store');
//     Route::get('/timesheets/{timesheet}/edit', 'edit');
//     Route::patch('/timesheets/{timesheet}', 'update');
//     Route::delete('/timesheets/{timesheet}', 'destroy');
// });

// Auth
Route::get('register', [RegisteredUserController::class, 'create']);
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store']);
