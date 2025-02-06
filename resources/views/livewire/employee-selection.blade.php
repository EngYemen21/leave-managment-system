<div class="flex items-center justify-center bg-gray-800 min-h-34">
    <div class="w-full max-w-md p-6 bg-gray-800 rounded-lg shadow-md">

        <h3 class="mb-4 text-lg font-semibold text-white dark:text-gray-300"> Login  </h3>
        <form wire:submit.prevent="submit">
            @csrf
            <div class="mb-4">
                <label for="employee" class="block text-sm font-medium text-white">selecte Employee :</label>
                <select id="employee" wire:model="selectedEmployeeId" class="w-full p-2 mt-1 border border-gray-300 rounded-md">
                    <option value=""> selecte Employee </option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                    @endforeach
                </select>
                @error('selectedEmployeeId') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="employeeNumber" class="block text-sm font-medium text-white">employee Number :</label>

                <input type="text" id="employeeNumber" wire:model="employeeNumber" class="block w-full p-2 mt-1 text-sm border border-gray-300 rounded-md focus:border-red-400 focus:outline-none focus:shadow-outline-red form-input"
                placeholder="  employee Number ">
                @error('employeeNumber') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>



            @if ($errorMessage)
                <div class="text-xs text-red-600 dark:text-red-400">{{ $errorMessage }}</div>
            @endif

            <div class="flex justify-center">
                <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
