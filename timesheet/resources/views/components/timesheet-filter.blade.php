<div class="py-4 mb-2">
    <form method="GET" action="{{ $action }}" class="flex flex-wrap gap-6 items-end">
        @if(isset($showEmployeeFilter) && $showEmployeeFilter && isset($employees))
        <div class="min-w-0">
            <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">Employee</label>
            <select name="employee_id" id="employee_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2 py-1">
                <option value="">All Employees</option>
                @foreach($employees as $employee)
                <option value="{{ $employee->id }}" {{ ($filters['employee_id'] ?? '') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="min-w-0">
            <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
            <select name="year" id="year" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2 py-1">
                <option value="">All Years</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ ($filters['year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div class="min-w-0">
            <label for="month" class="block text-sm font-medium text-gray-700 mb-2">Month</label>
            <select name="month" id="month" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-2 py-1">
                <option value="">All Months</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ ($filters['month'] ?? '') == $i ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                    @endfor
            </select>
        </div>

        <div class="flex-shrink-0">
            <button type="submit" class="inline-flex items-center px-2 py-1 border border-transparent text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Apply Filter
            </button>
        </div>
    </form>
</div>