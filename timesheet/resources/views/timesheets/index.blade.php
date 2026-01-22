<x-layout>
    <x-slot:heading>
        All Employees’ Timesheets
    </x-slot:heading>

    <div class="py-4 mb-2">
        <form method="GET" action="/timesheets" class="flex flex-wrap gap-6 items-end">
            <div class="min-w-0">
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-3">Employee</label>
                <select name="employee_id" id="employee_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">All Employees</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $filters['employee_id'] ?? '' == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="min-w-0">
                <label for="year" class="block text-sm font-medium text-gray-700 mb-3">Year</label>
                <select name="year" id="year" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">All Years</option>
                    @foreach($years as $year)
                    <option value="{{ $year }}" {{ $filters['year'] ?? '' == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="min-w-0">
                <label for="month" class="block text-sm font-medium text-gray-700 mb-3">Month</label>
                <select name="month" id="month" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">All Months</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $filters['month'] ?? '' == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                </select>
            </div>

            <div class="flex-shrink-0">
                <button type="submit" class="inline-flex items-center px-1 py-1 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Apply Filter
                </button>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
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
                    <td colspan="12" class="px-4 py-1 bg-gray-200 border-t-2 border-gray-400"></td>
                </tr>
                @endif
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900"><a href="/timesheets/{{ $timesheet['id'] }}" class="text-blue-500 hover:underline">{{ $timesheet->employee->name }}</a></td>
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
                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                        @if(Auth::user()->isAdmin())
                        <input
                            type="text"
                            class="sup-initial-input w-16 px-1 py-0.5 text-xs border border-gray-300 rounded focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                            data-timesheet-id="{{ $timesheet->id }}"
                            value="{{ $timesheet->supInitial }}"
                            placeholder="-"
                            maxlength="10">
                        @else
                        {{ $timesheet->supInitial ?? '-' }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $timesheets->links() }}
    </div>

    @if(Auth::user()->isAdmin())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const supInitialInputs = document.querySelectorAll('.sup-initial-input');

            supInitialInputs.forEach(input => {
                let originalValue = input.value;

                input.addEventListener('blur', function() {
                    const newValue = this.value.trim();
                    const timesheetId = this.dataset.timesheetId;

                    if (newValue !== originalValue) {
                        updateSupInitial(timesheetId, newValue, this);
                    }
                });

                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        this.blur();
                    }
                });
            });

            function updateSupInitial(timesheetId, value, inputElement) {
                inputElement.disabled = true;
                inputElement.style.opacity = '0.6';

                fetch(`/timesheets/${timesheetId}/sup-initial`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({
                            supInitial: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            originalValue = data.supInitial;
                            inputElement.value = data.supInitial;

                            showFeedback(inputElement, 'Saved!', 'success');
                        } else {
                            throw new Error('Update failed');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        inputElement.value = originalValue;
                        showFeedback(inputElement, 'Error saving', 'error');
                    })
                    .finally(() => {
                        inputElement.disabled = false;
                        inputElement.style.opacity = '1';
                    });
            }

            function showFeedback(element, message, type) {
                const existingFeedback = element.parentNode.querySelector('.feedback-message');
                if (existingFeedback) {
                    existingFeedback.remove();
                }

                const feedback = document.createElement('div');
                feedback.className = `feedback-message text-xs mt-1 ${type === 'success' ? 'text-green-600' : 'text-red-600'}`;
                feedback.textContent = message;

                element.parentNode.insertBefore(feedback, element.nextSibling);

                setTimeout(() => {
                    if (feedback.parentNode) {
                        feedback.remove();
                    }
                }, 2000);
            }
        });
    </script>
    @endif
</x-layout>