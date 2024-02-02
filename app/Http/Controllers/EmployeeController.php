<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Exports\EmployeeCompanyExport;
use App\Models\Company;
use App\Models\Division;
use App\Models\Employee;
use App\Models\EmployeeAsset;
use App\Models\Position;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-employee' , ['only' => ['index','show']]);
        $this->middleware('can:create-employee', ['only' => ['create','store']]);
        $this->middleware('can:update-employee', ['only' => ['edit','update']]);
        $this->middleware('can:delete-employee', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $page = "Master Data Employee";

        $company = Company::all();

        if ($request->ajax()) {
            $data = Employee::with('division', 'position', 'company')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('no', function ($row) {
                        static $no = 0;
                        return ++$no;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="/employees/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm">Edit</a> ';
                            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('employee.index', compact('page', 'company'));
    }

    public function create(){
        $page = "Create Data Employee";
        $company = Company::all();
        $division = Division::all();
        $position = Position::all();
        return view('employee.create',compact('page', 'company', 'division', 'position'));
    }

    public function getDivisionAndPosition(Request $request){
        $company_id = $request->input('company_id');
        $divisions = Division::where('company_id', $company_id)->get();
        $positions = Position::where('company_id', $company_id)->get();

        return response()->json(['divisions' => $divisions, 'positions' => $positions]);
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            "employee_name" => "required",
            "employee_code" => "required",
            "company_id" => "required",
            "division_id" => "required",
            "position_id" => "required",
            "email" => "required",
            "phone_number" => "required",
            "entry_date" => "required",
            "address" => "required",
            "asset" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $employee =   Employee::create(
                [
                    'employee_name' => $request->employee_name,
                    'employee_code' => $request->employee_code,
                    'company_id' => $request->company_id,
                    'division_id' => $request->division_id,
                    'position_id' => $request->position_id,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'entry_date' => $request->entry_date,
                    'address' => $request->address,
                    'description' => $request->description
                ]);

         if ($files = $request->file('asset')) {

            //delete old file
            File::delete('public/employee/'.$request->asset);


            //insert new file
            $destinationPath = 'public/employee/'; // upload path
            $filename = $request->employee_name . '.' . $files->getClientOriginalExtension();
            $files->move($destinationPath, $filename);
            // $size = $request->file('asset')->getSize();
            $url = $destinationPath . $filename;

            EmployeeAsset::create([
                'employee_id' => $employee->id,
                'file_name' => $filename,
                'url' => $url
            ]);
         }

        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully');

    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $asset = EmployeeAsset::where("employee_id", $id)->first();
        $company = Company::all();
        $division = Division::all();
        $position = Position::all();
        $page = "Edit Data Employee";

        // dd($asset);
        return view('employee.edit', compact('page', 'company', 'asset', 'employee', 'division', 'position'));
    }

    public function update($id, Request $request){
        $rules = [
            "employee_name" => "required",
            "employee_code" => "required",
            "company_id" => "required",
            "division_id" => "required",
            "position_id" => "required",
            "email" => "required",
            "phone_number" => "required",
            "entry_date" => "required",
            "address" => "required",
        ];

        $validatedData = $request->validate($rules);

        Employee::where('id', $id)->update($validatedData);

         if ($files = $request->file('asset')) {

            //delete old file
            File::delete('public/employee/'.$request->logo);
            EmployeeAsset::where('employee_id', $request->id)->delete();


            //insert new file
            $destinationPath = 'public/employee/'; // upload path
            $filename = $request->employee_name . '.' . $files->getClientOriginalExtension();
            $files->move($destinationPath, $filename);
            // $size = $request->file('asset')->getSize();
            $url = $destinationPath . $filename;

            EmployeeAsset::create([
                'employee_id' => $id,
                'file_name' => $filename,
                'url' => $url
            ]);
         }

        return redirect()->route('employees.index')
                        ->with('success','Update employee successfully');
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();
        return response()->json(['response'=>'Employee deleted successfully.']);
    }

    public function exportPdf()
    {
        $employees = Employee::with('division', 'position', 'company')->get();

        $view = view('employee.pdf', compact('employees'));

        $pdf = Pdf::loadHTML($view);

        return $pdf->download('employees_all.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new EmployeeExport, 'employee.xlsx');
    }

    public function indexByCompany(Request $request, $id){
        $page = "Master Data Employee";

        $company = Company::all();

        $param = Company::where("id", $id)->first();

        if ($request->ajax()) {
            $data = Employee::with('division', 'position', 'company')->where('company_id', $id)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('no', function ($row) {
                        static $no = 0;
                        return ++$no;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="/employees/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm">Edit</a> ';
                            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteEmployee">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('employee.company', compact('page', 'company', 'param'));
    }

    public function exportPdfID($id)
    {
        $employees = Employee::with('division', 'position', 'company')->where('company_id', $id)->get();
        $company = Company::where('id', $id)->pluck('company_name');

        $view = view('employee.pdf', compact('employees'));

        $pdf = Pdf::loadHTML($view);

        return $pdf->download('Employee' . '_' . $company .   '.pdf');
    }

    public function exportExcelID($id)
    {
        $employees = Employee::where('company_id', $id)
            ->with('division', 'position', 'company')
            ->get();

        $company = Company::where('id', $id)->pluck('company_name');


        return Excel::download(new EmployeeCompanyExport($employees), 'Employee' . '_' . $company .   '.xlsx');
    }
}
