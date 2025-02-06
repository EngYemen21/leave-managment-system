<div class="p-8 mt-12 bg-white rounded-lg shadow-lg">
    <h4 class="mb-6 text-2xl font-bold text-gray-800">قائمة طلبات الإجازة</h4>

    @if(session()->has('message'))
        <div class="p-3 mb-4 text-white bg-green-500 rounded">{{ session('message') }}</div>
    @endif
    @if(session()->has('error'))
        <div class="p-3 mb-4 text-white bg-red-500 rounded">{{ session('error') }}</div>
    @endif

    @if($editMode)
        <div class="p-6 mb-6 bg-gray-100 rounded-lg">
            <h4 class="mb-4 text-lg font-bold text-gray-700">تعديل طلب الإجازة</h4>
            <label class="block mb-2">من</label>
            <input type="date" wire:model="from_date" class="w-full p-2 mb-3 border rounded">
            <label class="block mb-2">إلى</label>
            <input type="date" wire:model="to_date" class="w-full p-2 mb-3 border rounded">
            <label class="block mb-2">السبب</label>
            <textarea wire:model="reason" class="w-full p-2 mb-3 border rounded"></textarea>
            <div class="flex space-x-3">
                <button wire:click="update" class="px-4 py-2 text-white bg-blue-500 rounded">تحديث</button>
                <button wire:click="$set('editMode', false)" class="px-4 py-2 text-white bg-gray-500 rounded">إلغاء</button>
            </div>
        </div>
    @endif

    <table class="min-w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-4 text-sm font-medium text-left text-gray-600">اسم الموظف</th>
                <th class="p-4 text-sm font-medium text-left text-gray-600">من</th>
                <th class="p-4 text-sm font-medium text-left text-gray-600">إلى</th>
                <th class="p-4 text-sm font-medium text-left text-gray-600">الحالة</th>
                <th class="p-4 text-sm font-medium text-left text-gray-600">الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leaveRequests as $request)
                <tr class="border-t">
                    <td class="p-4 text-sm text-gray-800">{{ $request->employee->employee_name }}</td>
                    <td class="p-4 text-sm text-gray-800">{{ $request->from_date }}</td>
                    <td class="p-4 text-sm text-gray-800">{{ $request->to_date }}</td>
                    <td class="p-4 text-sm">
                        <span class="px-2 py-1 text-white rounded-full
                            {{ $request->status == 'Pending' ? 'bg-yellow-500' : ($request->status == 'Approved' ? 'bg-green-500' : 'bg-red-500') }}">
                            {{ $request->status }}
                        </span>
                    </td>
                    <td class="p-4">
                        @if($request->status == 'Pending')
                            <button wire:click="edit({{ $request->id }})" class="px-3 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">تعديل</button>
                            <button wire:click="cancel({{ $request->id }})" class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">إلغاء</button>
                        @else
                            <span class="text-gray-500">لا يمكن التعديل أو الإلغاء</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-sm text-center text-gray-600">لا توجد طلبات حالياً.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
