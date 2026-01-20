<x-layout>
    <x-slot:heading>
        Edit Timesheet: {{ $timesheet->date }}
    </x-slot:heading>

    <form method="POST" action="/timesheets/{{ $timesheet->id }}">
        @csrf
        @method('PATCH')

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="date"
                                    id="date"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->date }}"
                                    placeholder="1/1/2026"
                                    required>
                            </div>
                            @error('date')
                            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="startTime" class="block text-sm font-medium leading-6 text-gray-900">Start Time</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="startTime"
                                    id="startTime"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->startTime }}"
                                    placeholder="7:45 am"
                                    required>
                            </div>
                            @error('startTime')
                            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="endTime" class="block text-sm font-medium leading-6 text-gray-900">End Time</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="endTime"
                                    id="endTime"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->endTime }}"
                                    placeholder="4:30 pm"
                                    required>
                                @error('endTime')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-6 flex items-center justify-between gap-x-6">
                <div class="flex items-center">
                    <button form="delete-form" class="text-red-500 text-sm font-bold">Delete</button>
                </div>

                <div class="flex items-center gap-x-6">
                    <a href="/timesheets/{{ $timesheet->id }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>

                    <div>
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Update
                        </button>
                    </div>
                </div>
            </div>
    </form>

    <form method="POST" action="/timesheets/{{ $timesheet->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>