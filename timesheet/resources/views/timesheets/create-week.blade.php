<x-layout>
    <x-slot:heading>
        Create Timesheets for Week
    </x-slot:heading>

    <form method="POST" action="/timesheets/create-week">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <x-form-field>
                        <x-form-label for="monday">Select Monday of the Week</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="monday" id="monday" type="date" required></x-form-input>
                            <x-form-error name="monday" />
                        </div>
                    </x-form-field>
                </div>

                <p class="mt-4 text-sm text-gray-600">
                    This will create empty timesheets for Monday through Sunday of the selected week.
                    Saturday and Sunday will be automatically set to "DO" status.
                    Existing timesheets will be skipped.
                </p>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/my-timesheets" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button>Create Week</x-form-button>
        </div>
    </form>
</x-layout>