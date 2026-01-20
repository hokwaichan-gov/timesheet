<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index()
    {
        $timesheets = Timesheet::with('employee')->latest()->paginate(50);
        return view('timesheets.index', [
            'timesheets' => $timesheets
        ]);
    }

    public function create()
    {
        return view('timesheets.create');
    }

    public function show(Timesheet $timesheet)
    {
        return view('timesheets.show', ['timesheet' => $timesheet]);
    }

    public function store()
    {
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
    }

    public function edit(Timesheet $timesheet)
    {
        return view('timesheets.edit', ['timesheet' => $timesheet]);
    }

    public function update(Timesheet $timesheet)
    {
        request()->validate([
            'date' => ['required', 'min:3'],
            'startTime' => ['required'],
            'endTime' => ['required'],
        ]);

        $timesheet->update([
            'date' => request('date'),
            'startTime' => request('startTime'),
            'endTime' => request('endTime'),
        ]);

        return redirect('/timesheets/' . $timesheet->id);
    }

    public function destroy(Timesheet $timesheet)
    {
        $timesheet->delete();
        return redirect('/timesheets');
    }
}
