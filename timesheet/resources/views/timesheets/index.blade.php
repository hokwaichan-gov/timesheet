<x-layout>
    <x-slot:heading>
        Timesheet Listings
    </x-slot:heading>

    <div class="space-y-4">
        @foreach ($timesheets as $timesheet)
        <a href="/timesheets/{{ $timesheet['id'] }}" class="block px-4 py-6 border border-gray-200 rounded-lg">
            <div class="font-bold text-blue-500 text-sm">{{ $timesheet->employee->name }}</div>
            <div>
                <strong>{{ $timesheet['date'] }}:</strong> START WORK: {{ $timesheet['startWork'] }} END WORK: {{ $timesheet['endWork'] }}. Emp Initial: {{ $timesheet['empInitial'] }}
                @if($timesheet['otHours'])
                (OT: {{ $timesheet['otHours'] }})
                @endif
            </div>
        </a>
        @endforeach
        <div>
            {{ $timesheets -> links() }}
        </div>
    </div>
</x-layout>