<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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

    public function myTimesheets()
    {
        $timesheets = Timesheet::where('employee_id', Auth::user()->employee->id)
            ->with('employee')
            ->latest()
            ->paginate(50);

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
            'employee_id' => Auth::user()->employee->id,
            'date' => request('date'),
            'startTime' => request('startTime'),
            'endTime' => request('endTime'),
        ]);
        return redirect('/timesheets');
    }

    public function edit(Timesheet $timesheet)
    {
        return view('timesheets.edit', ['timesheet' => $timesheet]);
    }

    public function update(Timesheet $timesheet)
    {
        Gate::authorize('edit', $timesheet);

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
        Gate::authorize('edit', $timesheet);

        $timesheet->delete();

        return redirect('/timesheets');
    }
}
