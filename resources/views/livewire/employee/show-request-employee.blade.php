<div class="">

    @if (session()->has('message'))
    <div class="p-4 mb-4 text-white bg-green-500 rounded">
        {{ session('message') }}
    </div>
    @endif
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">اسم الموظف</th>
                        <th class="px-4 py-3">نوع الإجازة</th>
                        <th class="px-4 py-3">من</th>
                        <th class="px-4 py-3">إلى</th>
                        <th class="px-4 py-3">الحالة</th>
                        <th class="px-4 py-3">الإجراءات</th>
                    </tr>
                </thead>


                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                </tbody>


                @forelse($leaveRequests as $request)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="object-cover w-full h-full rounded-full"
                                    src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                    alt="" loading="lazy" />
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $request->employee->employee_name }}</p>

                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $request->leaveType->leave_type_name }}
                    </td>
                    <td class="px-4 py-3 text-xs">

                        {{ $request->from_date }}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        {{ $request->to_date }}
                    </td>

                    <td class="px-4 py-3 text-sm">
                        @if ($request->status == 'pending')
                            <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-700 dark:text-yellow-100">
                                {{ $request->status }}
                            </span>
                        @elseif ($request->status == 'approved')
                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                {{ $request->status }}
                            </span>
                        @else
                            <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-100">
                                {{ $request->status }}
                            </span>
                        @endif
                    </td>

                    <td class="px-2 py-2 ">
                        <button wire:click="edit({{ $request->id }})" class="px-2 py-1 text-white bg-green-500 rounded">
                            تعديل
                        </button>
                        <button wire:click="cancel({{ $request->id }})" class="px-2 py-1 text-white bg-red-500 rounded">
                            الغاء
                        </button>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="p-4 text-center">لا توجد طلبات إجازة حالياً.</td>
                </tr>
                @endforelse


            </table>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing 21-30 of 100
            </span>
            <span class="col-span-2"></span>
            <!-- Pagination -->
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Previous">
                                <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                1
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                2
                            </button>
                        </li>
                        <li>
                            <button
                                class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                3
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                4
                            </button>
                        </li>
                        <li>
                            <span class="px-3 py-1">...</span>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                8
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                9
                            </button>
                        </li>
                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>
