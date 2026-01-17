<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Timesheet;

Route::get('/', function () {
    return view('home');
});

Route::get('/timesheets', function () {
    return view('timesheets', [
        'timesheets' => Timesheet::all()
    ]);
});

Route::get('/timesheets/{id}', function ($id) {
    $timesheet = Timesheet::find($id);
    return view('timesheet', ['timesheet' => $timesheet]);
});
