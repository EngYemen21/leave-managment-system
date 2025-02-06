<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Livewire\LeaveRequest;
use App\Models\EmployeeLeaveRequest;

class LeaveRequestsList extends Component
{
    public $leaveRequests;
    public $editMode = false;
    public $leave_id, $from_date, $to_date, $reason;

    public function mount() {
        $this->loadRequests();
    }

    public function loadRequests() {
        $this->leaveRequests = LeaveRequest::with('employee')->get();
    }

    // دالة لتحميل بيانات الطلب عند التعديل
    public function edit($id) {
        $leave = LeaveRequest::find($id);
        if ($leave->status !== 'Pending') {
            session()->flash('error', 'لا يمكنك تعديل طلب غير معلق.');
            return;
        }

        $this->leave_id = $leave->id;
        $this->from_date = $leave->from_date;
        $this->to_date = $leave->to_date;
        $this->reason = $leave->reason;

        $this->editMode = true;
    }

    public function update() {
        $this->validate([
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required|string|min:5',
        ]);

        $leave = LeaveRequest::find($this->leave_id);
        if ($leave->status !== 'Pending') {
            session()->flash('error', 'لا يمكنك تعديل طلب غير معلق.');
            return;
        }

        $leave->update([
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'reason' => $this->reason,
        ]);

        session()->flash('message', 'تم تحديث طلب الإجازة بنجاح.');
        $this->resetFields();
        $this->loadRequests();
    }

    // دالة لإلغاء الطلب
    public function cancel($id) {
        $leave = LeaveRequest::find($id);
        if ($leave->status !== 'Pending') {
            session()->flash('error', 'لا يمكنك إلغاء طلب غير معلق.');
            return;
        }

        $leave->update(['status' => 'Cancelled']);

        session()->flash('message', 'تم إلغاء طلب الإجازة.');
        $this->loadRequests();
    }

    // إعادة تعيين الحقول
    private function resetFields() {
        $this->leave_id = null;
        $this->from_date = null;
        $this->to_date = null;
        $this->reason = null;
        $this->editMode = false;
    }
    public function render()
    {
        return view('livewire.employee.leave-requests-list');
    }
}
