<?php


use App\Livewire\Auth\Logout;
use App\Livewire\LeaveRequest;
use App\Livewire\EmployeeSelection;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reports\LeaveSummaryReport;
use App\Livewire\Employee\ShowRequestEmployee;
use App\Livewire\Admin\AdminLeaveRequestsComponent;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', EmployeeSelection::class)->name('login');

Route::middleware(['auth:employees'])->group(function () {
Route::get('/leave-request', LeaveRequest::class)
    ->name('leave.request');
Route::get('/show-request', ShowRequestEmployee::class)
    ->name('leave.show.request');
Route::get('/leave-summary', LeaveSummaryReport::class)->name('leave.summary');

});

Route::middleware(['auth:employees'])->group(function () {
Route::get('/admin/dashboard', AdminLeaveRequestsComponent::class)->name('admin.dashboard');
    Route::post('/logout', Logout::class)->name('logout');
});
