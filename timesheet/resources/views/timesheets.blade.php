<x-layout>
    <x-slot:heading>
        Timesheet Listings
    </x-slot:heading>

    <ul>
        @foreach ($timesheets as $timesheet)
        <li>
            <a href="/timesheets/{{ $timesheet['id'] }}" class="text-blue-500 hover:underline">
                <strong>{{ $timesheet['date'] }}:</strong> Your startTime:{{ $timesheet['startTime'] }} and your endTime:{{ $timesheet['endTime'] }}.
            </a>
        </li>
        @endforeach
    </ul>
</x-layout>