<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EmployeeSelection extends Component
{
    public $employees;
    public $selectedEmployeeId;
    public $employeeNumber;
    public $errorMessage;

    public function mount()
    {
        $this->employees = Employee::all();
    }

    public function submit(Request $request)
{
    $this->validate([
        'selectedEmployeeId' => 'required|exists:employees,id',
        'employeeNumber' => 'required',
    ]);

    $employee = Employee::find($this->selectedEmployeeId);

    if (!$employee || $employee->employee_number != $this->employeeNumber) {
        $this->errorMessage = 'رقم الموظف غير صحيح.';
        return;
    }
    if(Auth::guard('employees')->attempt(['employee_number'=>$this->employeeNumber , 'id'=>$this->selectedEmployeeId  , 'password'=>12345])){
        return redirect()->route('admin.dashboard');
    }

}

    public function render()
    {
        return view('livewire.employee-selection');
    }
}
