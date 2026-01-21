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
            'startWork' => ['required'],
            'endWork' => ['required'],
            'empInitial' => ['required'],
            'status' => ['nullable'],
            'vacCtOther' => ['nullable'],
            'mealStart' => ['nullable'],
            'mealEnd' => ['nullable'],
            'otHours' => ['nullable', 'numeric'],
        ]);

        Timesheet::create([
            'employee_id' => Auth::user()->employee->id,
            'date' => request('date'),
            'startWork' => request('startWork'),
            'endWork' => request('endWork'),
            'empInitial' => request('empInitial'),
            'status' => request('status'),
            'vacCtOther' => request('vacCtOther'),
            'mealStart' => request('mealStart'),
            'mealEnd' => request('mealEnd'),
            'otHours' => request('otHours'),
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
            'startWork' => ['required'],
            'endWork' => ['required'],
            'empInitial' => ['required'],
            'status' => ['nullable'],
            'vacCtOther' => ['nullable'],
            'mealStart' => ['nullable'],
            'mealEnd' => ['nullable'],
            'otHours' => ['nullable', 'numeric'],
        ]);

        $timesheet->update([
            'date' => request('date'),
            'startWork' => request('startWork'),
            'endWork' => request('endWork'),
            'empInitial' => request('empInitial'),
            'status' => request('status'),
            'vacCtOther' => request('vacCtOther'),
            'mealStart' => request('mealStart'),
            'mealEnd' => request('mealEnd'),
            'otHours' => request('otHours'),
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
