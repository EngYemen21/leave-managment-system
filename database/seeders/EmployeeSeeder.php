<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Employee::create([
            'employee_name'   => 'Mohammed',
            'employee_number' => 'EMP001',
            'mobile_number'   => '01012345678',
            'password'=>Hash::make('12345'),
            'address'         => 'yemen',
            'note'            => 'web'
        ]);

        Employee::create([
            'employee_name'   => 'Ahmed',
            'employee_number' => 'EMP002',
            'password'=>Hash::make('12345'),
            'mobile_number'   => '01087654321',
            'address'         => 'yemen',
            'note'            => 'web'
        ]);
    }
}
