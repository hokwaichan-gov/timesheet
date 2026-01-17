<x-layout>
    <x-slot:heading>
        Timesheet
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $timesheet['date'] }}</h2>

    <p>
        This is the date you worked {{ $timesheet['date'] }}.
    </p>
</x-layout>