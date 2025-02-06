<div class="p-8 space-y-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700">اسم الموظف</label>
        <select wire:model="employee_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">اختر الموظف</option>
            @foreach($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
            @endforeach
        </select>
        @error('employee_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700">نوع الإجازة</label>
        <select wire:model="leave_type_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">اختر نوع الإجازة</option>
            @foreach($leaveTypes as $type)
                <option value="{{ $type->id }}">{{ $type->leave_type_name }}</option>
            @endforeach
        </select>
        @error('leave_type_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="flex mb-6 space-x-6">
        <div class="w-1/2">
            <label class="block text-lg font-medium text-gray-700">من</label>
            <input type="date" wire:model="from_date" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('from_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="w-1/2">
            <label class="block text-lg font-medium text-gray-700">إلى</label>
            <input type="date" wire:model="to_date" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('to_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700">السبب</label>
        <textarea wire:model="reason" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4"></textarea>
        @error('reason') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="mb-6">
        <label class="block text-lg font-medium text-gray-700">ملاحظات</label>
        <textarea wire:model="notes" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
        @error('notes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

    <button type="submit" wire:click="submit" class="w-full px-4 py-3 text-lg text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        إرسال الطلب
    </button>
</div>
