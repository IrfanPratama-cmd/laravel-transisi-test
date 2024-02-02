<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class EmployeeExport implements FromView
{
    use Exportable;

    public function view(): View
    {
        $employees = Employee::with('division', 'position', 'company')->get();

        return view('employee.excel', [
            'employees' => $employees,
        ]);
    }
}
