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
                        <label for="date" class="block text-sm font-medium leading-6 text-gray-900">DATE</label>
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
                        <label for="startWork" class="block text-sm font-medium leading-6 text-gray-900">START WORK</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="startWork"
                                    id="startWork"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->startWork }}"
                                    placeholder="7:45 am"
                                    required>
                            </div>
                            @error('startWork')
                            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="endWork" class="block text-sm font-medium leading-6 text-gray-900">END WORK</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="endWork"
                                    id="endWork"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->endWork }}"
                                    placeholder="4:30 pm"
                                    required>
                                @error('endWork')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">STATUS</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="status"
                                    id="status"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->status }}"
                                    placeholder="DO">
                                @error('status')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="vacCtOther" class="block text-sm font-medium leading-6 text-gray-900">VAC/CT OTHER</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="vacCtOther"
                                    id="vacCtOther"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->vacCtOther }}"
                                    placeholder="Vacation/Casual">
                                @error('vacCtOther')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="mealStart" class="block text-sm font-medium leading-6 text-gray-900">MEAL START</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="mealStart"
                                    id="mealStart"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->mealStart }}"
                                    placeholder="12:00 pm">
                                @error('mealStart')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="mealEnd" class="block text-sm font-medium leading-6 text-gray-900">MEAL END</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="mealEnd"
                                    id="mealEnd"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->mealEnd }}"
                                    placeholder="1:00 pm">
                                @error('mealEnd')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="empInitial" class="block text-sm font-medium leading-6 text-gray-900">EMP INITIAL</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="text"
                                    name="empInitial"
                                    id="empInitial"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->empInitial }}"
                                    placeholder="ABC"
                                    required>
                                @error('empInitial')
                                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="otHours" class="block text-sm font-medium leading-6 text-gray-900">OT HOURS</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input
                                    type="number"
                                    step="0.01"
                                    name="otHours"
                                    id="otHours"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                    value="{{ $timesheet->otHours }}"
                                    placeholder="1.5">
                                @error('otHours')
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