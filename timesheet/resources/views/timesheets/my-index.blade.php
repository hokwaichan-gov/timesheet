<x-layout>
    <x-slot:heading>
        {{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}’ Timesheets
    </x-slot:heading>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <x-timesheet-filter
        action="/my-timesheets"
        :years="$years"
        :filters="$filters"
        :showEmployeeFilter="false"
    />

    <x-timesheet-table
        :timesheets="$timesheets"
        :showEmployeeColumn="false"
        :isAdmin="false"
    />

    <div class="mt-4">
        {{ $timesheets->links() }}
    </div>
</x-layout>