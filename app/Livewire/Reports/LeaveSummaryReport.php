<?php

namespace App\Livewire\Reports;

use Mpdf\Mpdf; // تأكد من أنك تستخدم Mpdf بشكل صحيح
use Livewire\Component;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;

class LeaveSummaryReport extends Component
{
    public $leaveSummary = [];

    public function mount()
    {
        $this->loadReport();
    }

    // دالة تحميل التقرير الكلي
    public function loadReport()
    {
        $this->leaveSummary = Employee::withCount('leaveRequests')
            ->with(['leaveRequests' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->map(function ($employee) {
                return [
                    'employee_name' => $employee->employee_name,
                    'employee_number' => $employee->employee_number,
                    'mobile_number' => $employee->mobile_number,
                    'total_leave_requests' => $employee->leave_requests_count,
                    'last_leave_date' => optional($employee->leaveRequests->first())->from_date ?? 'N/A',
                    'last_leave_type' => optional($employee->leaveRequests->first())->leaveType->name ?? 'N/A',
                ];
            });
    }

    public function exportEmployeeReport($employeeNumber)
    {
        // العثور على الموظف باستخدام رقم الموظف
        $employee = Employee::where('employee_number', $employeeNumber)
                            ->with(['leaveRequests' => function ($query) {
                                $query->latest()->limit(1);
                            }])
                            ->first();

        if (!$employee) {
            // في حال لم يتم العثور على الموظف
            session()->flash('error', 'Employee not found');
            return;
        }

        // تجهيز بيانات الموظف لتوليد التقرير
        $employeeData = [
            'employee_name' => $employee->employee_name,
            'employee_number' => $employee->employee_number,
            'mobile_number' => $employee->mobile_number,
            'total_leave_requests' => $employee->leaveRequests->count(),
            'last_leave_date' => optional($employee->leaveRequests->first())->from_date ?? 'N/A',
            'last_leave_type' => optional($employee->leaveRequests->first())->leaveType->name ?? 'N/A',
        ];

        // تحميل عرض التقرير باستخدام مكتبة DomPDF
        $pdf = Pdf::loadView('livewire.reports.employee-report', ['employee' => $employeeData]);

        // إرسال التقرير كـ PDF لتحميله
        return response()->streamDownload(fn () => print($pdf->output()), "employee_{$employee->employee_number}_report.pdf");
    }


    // دالة لتصدير التقرير الكلي
    public function exportPdf()
    {
        $pdf = Pdf::loadView('livewire.reports.leave-summary-report', ['leaveSummary' => $this->leaveSummary]);
        return response()->streamDownload(fn () => print($pdf->output()), 'leave_summary_report.pdf');
    }

    public function render()
    {
        return view('livewire.reports.leave-summary-report');
    }
}
