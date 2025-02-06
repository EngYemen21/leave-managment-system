<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    //
    use HasFactory, Notifiable;
    protected $guard='employees';
    protected $fillable = [
        'employee_name', 'employee_number', 'mobile_number', 'address', 'note' , 'password',
    ];
    protected $hidden = [
        'password',
    ];



    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function leaveRequests()
    {
        return $this->hasMany(EmployeeLeaveRequest::class);
    }
}
