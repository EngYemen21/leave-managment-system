<div>
    <div class="flex justify-end">
        <button wire:click="exportPdf" class="px-4 py-2 text-white bg-blue-500 rounded">Download PDF Report</button>
    </div>
    <div class="mt-4 overflow-x-auto">
        <table class="min-w-full text-white border border-collapse border-gray-300">
            <thead>
                <tr>
                    <th class="p-2 border border-gray-300">Employee Name</th>
                    <th class="p-2 border border-gray-300">Employee Number</th>
                    <th class="p-2 border border-gray-300">Phone Number</th>
                    <th class="p-2 border border-gray-300">Total Leave Requests</th>
                    <th class="p-2 border border-gray-300">Last Leave Request Date</th>
                    <th class="p-2 border border-gray-300">Last Leave Type</th>
                    <th class="p-2 border border-gray-300">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveSummary as $summary)
                    <tr>
                        <td class="p-2 border border-gray-300">{{ $summary['employee_name'] }}</td>
                        <td class="p-2 border border-gray-300">{{ $summary['employee_number'] }}</td>
                        <td class="p-2 border border-gray-300">{{ $summary['mobile_number'] }}</td>
                        <td class="p-2 border border-gray-300">{{ $summary['total_leave_requests'] }}</td>
                        <td class="p-2 border border-gray-300">{{ $summary['last_leave_date'] }}</td>
                        <td class="p-2 border border-gray-300">{{ $summary['last_leave_type'] ?? '-' }}</td>
                        <td class="p-2 border border-gray-300">
                            <button wire:click="exportEmployeeReport({{ $summary['employee_number'] }})"
                                    class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                                Print Report
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
