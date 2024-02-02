<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-dashboard');
    }

    public function index(){
        $page = 'Dashboard';
        $company = Company::count();
        $division = Division::count();
        $position = Position::count();
        $employee = Employee::count();

        return view('dashboard', compact('page', 'company', 'division', 'position', 'employee'));
    }
}
