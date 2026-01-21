<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    public function index(Request $request)
    {
        $query = Timesheet::with('employee');

        // Apply filters
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        if ($request->filled('year')) {
            $query->where('date', 'LIKE', $request->year . '-%');
        }

        if ($request->filled('month')) {
            $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
            $query->where('date', 'LIKE', '%-' . $month . '-%');
        }

        $timesheets = $query->latest()->paginate(50);

        // Get filter options
        $employees = \App\Models\Employee::orderBy('name')->get();
        $years = Timesheet::selectRaw('DISTINCT YEAR(date) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('timesheets.index', [
            'timesheets' => $timesheets,
            'employees' => $employees,
            'years' => $years,
            'filters' => $request->only(['employee_id', 'year', 'month'])
        ]);
    }

    public function myTimesheets(Request $request)
    {
        $query = Timesheet::where('employee_id', Auth::user()->employee->id)
            ->with('employee');

        // Apply filters
        if ($request->filled('year')) {
            $query->where('date', 'LIKE', $request->year . '-%');
        }

        if ($request->filled('month')) {
            $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
            $query->where('date', 'LIKE', '%-' . $month . '-%');
        }

        $timesheets = $query->orderByDesc('date')->paginate(50);

        // Get available years
        $years = Timesheet::where('employee_id', Auth::user()->employee->id)
            ->selectRaw('DISTINCT YEAR(date) as year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('timesheets.my-index', [
            'timesheets' => $timesheets,
            'years' => $years,
            'filters' => $request->only(['year', 'month'])
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
