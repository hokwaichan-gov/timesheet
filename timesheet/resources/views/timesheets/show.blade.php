<x-layout>
    <x-slot:heading>
        Timesheet
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $timesheet->date }}</h2>

    <p>
        This is the hours you worked {{ $timesheet->startWork }} - {{ $timesheet->endWork }}.
    </p>

    @if($timesheet->status)
    <p>
        Status(DO): {{ $timesheet->status }}
    </p>
    @endif

    @if($timesheet->vacCtOther)
    <p>
        VAC/CT Other: {{ $timesheet->vacCtOther }}
    </p>
    @endif

    @if($timesheet->mealStart)
    <p>
        Meal Start: {{ $timesheet->mealStart }}
    </p>
    @endif

    @if($timesheet->mealEnd)
    <p>
        Meal End: {{ $timesheet->mealEnd }}
    </p>
    @endif

    <p>
        Emp Initial: {{ $timesheet->empInitial }}
    </p>

    @if($timesheet->otHours)
    <p>
        Ot Hours: {{ $timesheet->otHours }}
    </p>
    @endif

    @can('edit', $timesheet)
    <p class="mt-6">
        <x-button href="/timesheets/{{ $timesheet->id }}/edit">Edit Timesheet</x-button>
    </p>
    @endcan
</x-layout>