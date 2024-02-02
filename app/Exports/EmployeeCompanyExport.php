<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeCompanyExport implements FromCollection, WithHeadings
{
    protected $employees;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {
        return $this->employees;
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Employee Code',
            'Company Name',
            'Division Name',
            'Position Name',
            'Email',
            'Phone Number',
            'Entry Date',
            'Address',
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->employee_name,
            $employee->employee_code,
            $employee->company->company_name,
            $employee->division->division_name,
            $employee->position->position_name,
            $employee->email,
            $employee->phone_number,
            $employee->entry_date,
            $employee->address,
        ];
    }
}
