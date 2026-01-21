<x-layout>
    <x-slot:heading>
        Timesheet Details
    </x-slot:heading>

    <div class="bg-white overflow-hidden shadow rounded-lg max-w-4xl mx-auto">
        <div class="px-6 py-8 sm:p-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <h3 class="text-2xl font-medium text-gray-900">{{ $timesheet->date }} ({{ strtoupper(\Carbon\Carbon::parse($timesheet->date)->format('l')) }})</h3>
                    <p class="mt-2 text-lg text-gray-600">Employee: {{ $timesheet->employee->name }}</p>
                </div>
                <div class="sm:text-right">
                    <p class="text-lg text-gray-600">EMP INITIAL: {{ $timesheet->empInitial }}</p>
                    @if($timesheet->otHours)
                    <p class="text-lg text-gray-600">Overtime Hours: {{ $timesheet->otHours }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <h4 class="text-lg font-medium text-gray-900">Work Hours</h4>
                    <p class="mt-2 text-lg text-gray-600">START: {{ $timesheet->startWork }}</p>
                    <p class="text-lg text-gray-600">END: {{ $timesheet->endWork }}</p>
                </div>

                @if($timesheet->mealStart || $timesheet->mealEnd)
                <div>
                    <h4 class="text-lg font-medium text-gray-900">Meal Break</h4>
                    @if($timesheet->mealStart)
                    <p class="mt-2 text-lg text-gray-600">START: {{ $timesheet->mealStart }}</p>
                    @endif
                    @if($timesheet->mealEnd)
                    <p class="text-lg text-gray-600">END: {{ $timesheet->mealEnd }}</p>
                    @endif
                </div>
                @endif
            </div>

            @if($timesheet->status || $timesheet->vacCtOther)
            <div class="mt-4">
                <h4 class="text-lg font-medium text-gray-900">Additional Information</h4>
                <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-2">
                    @if($timesheet->status)
                    <p class="text-lg text-gray-600">STATUS: {{ $timesheet->status }}</p>
                    @endif
                    @if($timesheet->vacCtOther)
                    <p class="text-lg text-gray-600">VAC/CT OTHER: {{ $timesheet->vacCtOther }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="bg-gray-50 px-6 py-6 sm:px-8">
            @can('edit', $timesheet)
            <x-button href="/timesheets/{{ $timesheet->id }}/edit">Edit Timesheet</x-button>
            @endcan
        </div>
    </div>
</x-layout>