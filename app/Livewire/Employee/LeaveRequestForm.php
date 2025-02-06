<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\EmployeeLeaveRequest;

class LeaveRequestForm extends Component
{

    public $employee_id;
    public $leave_type_id;
    public $from_date;
    public $to_date;
    public $reason;
    public $notes;

    public function submit()
    {
        $this->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after:from_date',
            'reason' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $overlap = EmployeeLeaveRequest::where('employee_id', $this->employee_id)
            ->where(function($query) {
                $query->whereBetween('from_date', [$this->from_date, $this->to_date])
                      ->orWhereBetween('to_date', [$this->from_date, $this->to_date])
                      ->orWhere(function($q) {
                          $q->where('from_date', '<=', $this->from_date)
                            ->where('to_date', '>=', $this->to_date);
                      });
            })->exists();

        if ($overlap) {
            $this->addError('from_date', 'يوجد طلب إجازة متداخل مع التواريخ المحددة.');
            return;
        }

        EmployeeLeaveRequest::create([
            'employee_id' => $this->employee_id,
            'leave_type_id' => $this->leave_type_id,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'reason' => $this->reason,
            'notes' => $this->notes,
            'status' => 'pending',
        ]);

        session()->flash('message', 'تم تقديم طلب الإجازة بنجاح.');
        $this->reset();
    }

    public function render()
    {
        $employees = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('livewire.employee.leave-request-form', compact('employees', 'leaveTypes'));
    }
}


