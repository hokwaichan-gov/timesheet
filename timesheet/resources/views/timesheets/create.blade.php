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
                        <x-form-label for="startWork">START WORK</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="startWork" id="startWork" type="time" required></x-form-input>
                            <x-form-error name="startWork" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="endWork">END WORK</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="endWork" id="endWork" type="time" required></x-form-input>
                            <x-form-error name="endWork" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="status">STATUS</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="status" id="status" type="text" placeholder="DO"></x-form-input>
                            <x-form-error name="status" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="vacCtOther">VAC/CT OTHER</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="vacCtOther" id="vacCtOther" type="text" placeholder="Vacation/Casual"></x-form-input>
                            <x-form-error name="vacCtOther" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="mealStart">MEAL START</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="mealStart" id="mealStart" type="time"></x-form-input>
                            <x-form-error name="mealStart" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="mealEnd">MEAL END</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="mealEnd" id="mealEnd" type="time"></x-form-input>
                            <x-form-error name="mealEnd" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="empInitial">EMP INITIAL</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="empInitial" id="empInitial" type="text" placeholder="ABC" required></x-form-input>
                            <x-form-error name="empInitial" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="otHours">OT HOURS</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="otHours" id="otHours" type="number" step="0.01" placeholder="1.5"></x-form-input>
                            <x-form-error name="otHours" />
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