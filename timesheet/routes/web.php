<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Timesheet;

Route::get('/', function () {
    return view('home');
});

//Index
Route::get('/timesheets', function () {
    $timesheets = Timesheet::with('employee')->latest()->paginate(3);
    return view('timesheets.index', [
        'timesheets' => $timesheets
    ]);
});

//Create
Route::get('/timesheets/create', function () {
    return view('timesheets.create');
});

Route::get('/timesheets/{id}', function ($id) {
    $timesheet = Timesheet::find($id);

    return view('timesheets.show', ['timesheet' => $timesheet]);
});

//Store
Route::post('/timesheets', function () {
    request()->validate([
        'date' => ['required', 'min:3'],
        'startTime' => ['required'],
        'endTime' => ['required'],
    ]);

    Timesheet::create([
        'employee_id' => 1,
        'date' => request('date'),
        'startTime' => request('startTime'),
        'endTime' => request('endTime'),
    ]);
    return redirect('timesheets');
});

//Edit
Route::get('/timesheets/{id}/edit', function ($id) {
    $timesheet = Timesheet::find($id);
    return view('timesheets.edit', ['timesheet' => $timesheet]);
});

//Update
Route::patch('/timesheets/{id}', function ($id) {
    request()->validate([
        'date' => ['required', 'min:3'],
        'startTime' => ['required'],
        'endTime' => ['required'],
    ]);

    $timesheet = Timesheet::findOrFail($id);
    $timesheet->update([
        'date' => request('date'),
        'startTime' => request('startTime'),
        'endTime' => request('endTime'),
    ]);

    return redirect('/timesheets/' . $timesheet->id);
});

//Destroy
Route::delete('/timesheets/{id}', function ($id) {
    Timesheet::findOrFail($id)->delete();
    return redirect('/timesheets');
});
