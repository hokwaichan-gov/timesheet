<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Timesheet;

Route::get('/', function () {
    return view('home');
});

Route::get('/timesheets', function () {
    $timesheets = Timesheet::with('employee')->latest()->paginate(3);
    return view('timesheets.index', [
        'timesheets' => $timesheets
    ]);
});

Route::get('/timesheets/create', function () {
    return view('timesheets.create');
});

Route::get('/timesheets/{id}', function ($id) {
    $timesheet = Timesheet::find($id);
    return view('timesheets.show', ['timesheet' => $timesheet]);
});

Route::post('/timesheets', function () {
    Timesheet::create([
        'employee_id' => 1,
        'date' => request('date'),
        'startTime' => request('startTime'),
        'endTime' => request('endTime'),
    ]);
    return redirect('timesheets');
});
