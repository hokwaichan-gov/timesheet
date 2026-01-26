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

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vac/Ct other</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Work</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meal Start</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meal End</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Work</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EMP initial</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">OT hours</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SUP initial</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @php $previousWeek = null; @endphp
                @foreach ($timesheets as $timesheet)
                @php
                $currentWeek = \Carbon\Carbon::parse($timesheet->date)->format('Y-W');
                $isNewWeek = $previousWeek !== null && $previousWeek !== $currentWeek;
                $previousWeek = $currentWeek;
                @endphp
                @if($isNewWeek)
                <tr>
                    <td colspan="11" class="px-4 py-1 bg-gray-200 border-t-2 border-gray-400"></td>
                </tr>
                @endif
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900"><a href="/timesheets/{{ $timesheet->id }}" class="text-blue-500 hover:underline">{{ $timesheet->date }}</a></td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ strtoupper(\Carbon\Carbon::parse($timesheet->date)->format('D')) }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->status ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->vacCtOther ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->startWork }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->mealStart ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->mealEnd ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->endWork }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->empInitial }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->otHours ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->supInitial ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $timesheets->links() }}
    </div>
</x-layout>