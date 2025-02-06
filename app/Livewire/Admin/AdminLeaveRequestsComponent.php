<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\EmployeeLeaveRequest;

class AdminLeaveRequestsComponent extends Component
{
    public $leaveRequests;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $this->leaveRequests = EmployeeLeaveRequest::with('employee', 'leaveType')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function approve($id)
    {
        $request = EmployeeLeaveRequest::findOrFail($id);
        $request->update(['status' => 'approved']);
        session()->flash('message', 'تمت الموافقة على الطلب بنجاح.');
        $this->loadRequests();
    }

    public function reject($id)
    {
        $request = EmployeeLeaveRequest::findOrFail($id);
        $request->update(['status' => 'rejected']);
        session()->flash('message', 'تم رفض الطلب.');
        $this->loadRequests();
    }

    public function render()
    {
        return view('livewire.admin.admin-leave-requests-component');
    }
}
