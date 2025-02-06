<div class="max-w-4xl p-4 mx-auto">
    <h3 class="mb-6 text-3xl font-bold text-white">Leave Request Management</h3>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-white bg-green-500 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Leave Request Form -->
    <form wire:submit.prevent="submit" class="p-6 mb-8 bg-white rounded shadow">
        <div class="mb-4">
            <label class="block text-gray-700">Employee Name</label>
            <select wire:model="employee_id" class="w-full p-2 border rounded">
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->employee_name }}</option>
                @endforeach
            </select>
            @error('employee_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Leave Type</label>
            <select wire:model="leave_type_id" class="w-full p-2 border rounded">
                <option value="">Select Leave Type</option>
                @foreach($leaveTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->leave_type_name }}</option>
                @endforeach
            </select>
            @error('leave_type_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex mb-4 space-x-4">
            <div class="w-1/2">
                <label class="block text-gray-700">From</label>
                <input type="date" wire:model="from_date" class="w-full p-2 border rounded">
                @error('from_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-1/2">
                <label class="block text-gray-700">To</label>
                <input type="date" wire:model="to_date" class="w-full p-2 border rounded">
                @error('to_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Reason</label>
            <textarea wire:model="reason" class="w-full p-2 border rounded" rows="3"></textarea>
            @error('reason') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Notes</label>
            <textarea wire:model="notes" class="w-full p-2 border rounded" rows="2"></textarea>
            @error('notes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">
            Submit Request
        </button>
    </form>

    <!-- Leave Requests List -->
    <div class="p-6 bg-white rounded shadow">
        <h2 class="mb-4 text-2xl font-bold">Leave Requests List</h2>
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Employee Name</th>
                    <th class="p-2 border">Leave Type</th>
                    <th class="p-2 border">From</th>
                    <th class="p-2 border">To</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaveRequests as $request)
                    <tr>
                        <td class="p-2 border">{{ $request->employee->employee_name }}</td>
                        <td class="p-2 border">{{ $request->leaveType->leave_type_name }}</td>
                        <td class="p-2 border">{{ $request->from_date }}</td>
                        <td class="p-2 border">{{ $request->to_date }}</td>
                        <td class="p-2 border">{{ $request->status }}</td>
                        <td class="p-2 border">
                            <button wire:click="edit({{ $request->id }})" class="px-2 py-1 text-white bg-yellow-500 rounded">Edit</button>
                            <button wire:click="cancel({{ $request->id }})" class="px-2 py-1 text-white bg-red-500 rounded">Cancel</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center">No requests available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
