<?php

use Illuminate\Support\Facades\Route;
use App\Models\Timesheet;
use App\Http\Controllers\TimesheetController;

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
