<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\EmployeeLeaveRequest;

class ShowRequestEmployee extends Component
{

    public $leaveRequests;
    public function mount()
    {
        $this->loadLeaveRequests();
    }

    public function loadLeaveRequests()
    {
        $this->leaveRequests = EmployeeLeaveRequest::with('employee', 'leaveType')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {  
        return view('livewire.employee.show-request-employee');
    }
}
