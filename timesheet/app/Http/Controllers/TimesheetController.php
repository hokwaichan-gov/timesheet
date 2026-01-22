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

        if ($request->filled('year')) {
            $query->where('date', 'LIKE', $request->year . '-%');
        }

        if ($request->filled('month')) {
            $month = str_pad($request->month, 2, '0', STR_PAD_LEFT);
            $query->where('date', 'LIKE', '%-' . $month . '-%');
        }

        $timesheets = $query->orderByDesc('date')->paginate(50);

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
            'date' => [
                'required',
                'min:3',
                function ($attribute, $value, $fail) {
                    $exists = Timesheet::where('employee_id', Auth::user()->employee->id)
                        ->where('date', $value)
                        ->exists();

                    if ($exists) {
                        $fail('A timesheet for this date already exists.');
                    }
                },
            ],
            'status' => ['nullable'],
            'vacCtOther' => ['nullable'],
            'startWork' => ['nullable'],
            'mealStart' => ['nullable'],
            'mealEnd' => ['nullable'],
            'endWork' => ['nullable'],
            'empInitial' => ['nullable'],
            'supInitial' => ['nullable'],
            'otHours' => ['nullable', 'numeric'],
        ]);

        Timesheet::create([
            'employee_id' => Auth::user()->employee->id,
            'date' => request('date'),
            'status' => request('status'),
            'vacCtOther' => request('vacCtOther'),
            'startWork' => request('startWork'),
            'mealStart' => request('mealStart'),
            'mealEnd' => request('mealEnd'),
            'endWork' => request('endWork'),
            'empInitial' => request('empInitial'),
            'supInitial' => request('supInitial'),
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
            'status' => ['nullable'],
            'vacCtOther' => ['nullable'],
            'startWork' => ['nullable'],
            'mealStart' => ['nullable'],
            'mealEnd' => ['nullable'],
            'endWork' => ['nullable'],
            'empInitial' => ['nullable'],
            'supInitial' => ['nullable'],
            'otHours' => ['nullable', 'numeric'],
        ]);

        $timesheet->update([
            'date' => request('date'),
            'status' => request('status'),
            'vacCtOther' => request('vacCtOther'),
            'startWork' => request('startWork'),
            'mealStart' => request('mealStart'),
            'mealEnd' => request('mealEnd'),
            'endWork' => request('endWork'),
            'empInitial' => request('empInitial'),
            'supInitial' => request('supInitial'),
            'otHours' => request('otHours'),
        ]);

        return redirect('/timesheets/' . $timesheet->id);
    }

    public function updateSupInitial(Timesheet $timesheet)
    {
        Gate::authorize('edit', $timesheet);

        request()->validate([
            'supInitial' => ['nullable', 'string', 'max:10'],
        ]);

        $timesheet->update([
            'supInitial' => request('supInitial'),
        ]);

        return response()->json(['success' => true, 'supInitial' => $timesheet->supInitial]);
    }

    public function destroy(Timesheet $timesheet)
    {
        Gate::authorize('edit', $timesheet);

        $timesheet->delete();

        return redirect('/timesheets');
    }
}
