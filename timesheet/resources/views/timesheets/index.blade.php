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