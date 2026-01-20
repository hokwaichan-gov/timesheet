<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Timesheet;

Route::get('/', function () {
    return view('home');
});

Route::get('/timesheets', function () {
    $timesheets = Timesheet::with('employee')->get();
    return view('timesheets', [
        'timesheets' => $timesheets
    ]);
});

Route::get('/timesheets/{id}', function ($id) {
    $timesheet = Timesheet::find($id);
    return view('timesheet', ['timesheet' => $timesheet]);
});
