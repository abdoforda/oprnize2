<?php

namespace App\Exports;

use App\Employee;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmployeeExport implements FromView
{

    public function view(): View
    {
        return view('employee.export', [
            'employees' => Employee::all()
        ]);
    }

}
