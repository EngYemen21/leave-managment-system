<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        LeaveType::create(['leave_type_name' => 'Sick Leave']);
        LeaveType::create(['leave_type_name' => 'Annual Leave']);
        LeaveType::create(['leave_type_name' => 'Maternity Leave']);
        LeaveType::create(['leave_type_name' => 'Casual Leave']);
        LeaveType::create(['leave_type_name' => 'others']);
    }
}
