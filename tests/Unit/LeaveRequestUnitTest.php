<?php

// tests/Unit/LeaveRequestUnitTest.php
namespace Tests\Unit;

use Tests\TestCase;
use App\Livewire\LeaveRequest;

class LeaveRequestUnitTest extends TestCase
{
    public function test_leave_request_dates_are_valid()
    {
        // إنشاء طلب إجازة
        $leaveRequest = new LeaveRequest([
            'from_date' => '2025-02-06',
            'to_date' => '2025-02-10',
        ]);

        // تحقق من أن التواريخ المدخلة صحيحة
        $this->assertTrue($leaveRequest->validateDates());
    }

    public function test_leave_request_dates_are_invalid()
    {
        $leaveRequest = new LeaveRequest([
            'from_date' => '2025-02-10',
            'to_date' => '2025-02-06',
        ]);

        // تحقق من أن التواريخ غير صحيحة
        $this->assertFalse($leaveRequest->validateDates());
    }
}
