<x-layout>
    <x-slot:heading>
        Create Timesheet
    </x-slot:heading>

    <form method="POST" action="/timesheets">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="date">Date</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="date" id="date" type="date" placeholder="1/1/2026" required></x-form-input>
                            <x-form-error name="date" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="startTime">Start Time</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="startTime" id="startTime" type="startTime" placeholder="7:45 am" required></x-form-input>
                            <x-form-error name="startTime" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="endTime">End Time</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="endTime" id="endTime" type="endTime" placeholder="4:30 pm" required></x-form-input>
                            <x-form-error name="endTime" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <x-form-button>Save</x-form-button>
        </div>
    </form>
</x-layout>