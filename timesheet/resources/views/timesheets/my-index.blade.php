<x-layout>
    <x-slot:heading>
        My Timesheets
    </x-slot:heading>

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
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($timesheets as $timesheet)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->date }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ strtoupper(\Carbon\Carbon::parse($timesheet->date)->format('D')) }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->status ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->vacCtOther ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->startWork }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->mealStart ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->mealEnd ?? '-' }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->endWork }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->empInitial }}</td>
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">{{ $timesheet->otHours ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $timesheets->links() }}
    </div>
</x-layout>