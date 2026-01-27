<x-layout>
    <x-slot:heading>
        All Employees’ Timesheets
    </x-slot:heading>

    <x-timesheet-filter
        action="/timesheets"
        :years="$years"
        :filters="$filters"
        :employees="$employees"
        :showEmployeeFilter="true"
    />

    <x-timesheet-table
        :timesheets="$timesheets"
        :showEmployeeColumn="true"
        :isAdmin="Auth::user()->isAdmin()"
    />

    <div class="mt-4">
        {{ $timesheets->links() }}
    </div>
</x-layout>