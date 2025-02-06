<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\EmployeeLeaveRequest;

class LeaveRequest extends Component
{

    public $employee_id;
    public $leave_type_id;
    public $from_date;
    public $to_date;
    public $reason;
    public $notes;

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

    protected function rules()
    {
        return [
            'employee_id'   => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'from_date'     => 'required|date',
            'to_date'       => 'required|date|after:from_date',
            'reason'        => 'nullable|string',
            'notes'         => 'nullable|string',
        ];
    }

    public function submit()
    {
        $this->validate();

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
            'employee_id'   => $this->employee_id,
            'leave_type_id' => $this->leave_type_id,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'reason'        => $this->reason,
            'notes'         => $this->notes,
            'status'        => 'pending',
        ]);

        session()->flash('message', 'تم تقديم طلب الإجازة بنجاح.');
        $this->reset(['leave_type_id', 'from_date', 'to_date', 'reason', 'notes']);
        $this->loadLeaveRequests();
    }

    public function edit($id)
    {
        $leave = EmployeeLeaveRequest::findOrFail($id);
        $this->employee_id   = $leave->employee_id;
        $this->leave_type_id = $leave->leave_type_id;
        $this->from_date     = $leave->from_date;
        $this->to_date       = $leave->to_date;
        $this->reason        = $leave->reason;
        $this->notes         = $leave->notes;
    }

    public function update($id)
    {
        $leave = EmployeeLeaveRequest::findOrFail($id);
        $this->validate();

        $overlap = EmployeeLeaveRequest::where('employee_id', $this->employee_id)
            ->where('id', '!=', $id)
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

        $leave->update([
            'leave_type_id' => $this->leave_type_id,
            'from_date'     => $this->from_date,
            'to_date'       => $this->to_date,
            'reason'        => $this->reason,
            'notes'         => $this->notes,
        ]);

        session()->flash('message', 'تم تعديل طلب الإجازة بنجاح.');
        $this->reset(['leave_type_id', 'from_date', 'to_date', 'reason', 'notes']);
        $this->loadLeaveRequests();
    }

    public function cancel($id)
    {
        $leave = EmployeeLeaveRequest::findOrFail($id);
        $leave->delete();
        session()->flash('message', 'تم إلغاء طلب الإجازة.');
        $this->loadLeaveRequests();
    }

    public function render()
    {
        $employees  = Employee::all();
        $leaveTypes = LeaveType::all();
        return view('livewire.leave-request-component', compact('employees', 'leaveTypes'));

}

}
