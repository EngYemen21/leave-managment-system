<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveType extends Model
{  use HasFactory;
    //
    protected $fillable = [
        'leave_type_name'
    ];

    public function leaveRequests()
    {
        return $this->hasMany(EmployeeLeaveRequest::class);
    }
}
