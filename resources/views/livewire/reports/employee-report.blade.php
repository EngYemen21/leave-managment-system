<div class="max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-lg">
    <h1 class="mb-6 text-3xl font-semibold text-center text-blue-600">Employee Report</h1>

    <table class="min-w-full text-center border border-collapse border-gray-300 table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-4 text-left border border-gray-300">Employee Name</th>
                <th class="p-4 text-left border border-gray-300">Employee Number</th>
                <th class="p-4 text-left border border-gray-300">Phone Number</th>
                <th class="p-4 text-left border border-gray-300">Total Leave Requests</th>
                <th class="p-4 text-left border border-gray-300">Last Leave Date</th>
                <th class="p-4 text-left border border-gray-300">Last Leave Type</th>
            </tr>
        </thead>
        <tbody>
            <tr class="hover:bg-gray-100">
                <td class="p-4 border border-gray-300">{{ $employee['employee_name'] }}</td>
                <td class="p-4 border border-gray-300">{{ $employee['employee_number'] }}</td>
                <td class="p-4 border border-gray-300">{{ $employee['mobile_number'] }}</td>
                <td class="p-4 border border-gray-300">{{ $employee['total_leave_requests'] }}</td>
                <td class="p-4 border border-gray-300">{{ $employee['last_leave_date'] }}</td>
                <td class="p-4 border border-gray-300">{{ $employee['last_leave_type'] }}</td>
            </tr>
        </tbody>
    </table>
</div>
