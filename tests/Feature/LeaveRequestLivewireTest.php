<?php

namespace Tests\Feature;

use App\Livewire\LeaveRequest as LivewireLeaveRequest;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Livewire\Livewire;
use Tests\TestCase;

class LeaveRequestLivewireTest extends TestCase
{
    // اختبارات الميزة (Feature Tests)
    public function test_employee_can_request_leave_using_livewire()
    {
        $employee = Employee::factory()->create();
        $leaveType = LeaveType::factory()->create();

        Livewire::test(LivewireLeaveRequest::class)
            ->set('employee_id', $employee->id)
            ->set('leave_type_id', $leaveType->id)
            ->set('from_date', now()->addDays(1)->toDateString())
            ->set('to_date', now()->addDays(3)->toDateString())
            ->set('reason', 'مرض')
            ->set('notes', 'ملاحظات')
            ->call('submit') 
            ->assertStatus(200)
            ->assertJson(['message' => 'Leave request submitted successfully']);
    }
}
