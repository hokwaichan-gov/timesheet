<x-layout>
    <x-slot:heading>
        Timesheet
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $timesheet->date }}</h2>

    <p>
        This is the hours you worked {{ $timesheet->startTime }} - {{ $timesheet->endTime }}.
    </p>

    @can('edit', $timesheet)
    <p class="mt-6">
        <x-button href="/timesheets/{{ $timesheet->id }}/edit">Edit Timesheet</x-button>
    </p>
    @endcan
</x-layout>