<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-division' , ['only' => ['index','show']]);
        $this->middleware('can:create-division', ['only' => ['create','store']]);
        $this->middleware('can:update-division', ['only' => ['edit','update']]);
        $this->middleware('can:delete-division', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $page = "Master Data Division";
        $company = Company::all();

        if ($request->ajax()) {
            $data = Division::with('company')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('no', function ($row) {
                        static $no = 0;
                        return ++$no;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDivision">Edit</a> ';
                            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDivision">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('division.index', compact('page', 'company'));
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            "company_id" => "required",
            "division_name" => "required"
        ]);

        Division::updateOrCreate(['id' => $request->id],
        ['company_id' => $request->company_id ,'division_name' => $request->division_name]);

        return response()->json(['success'=>'Division saved successfully.']);

    }

    public function edit($id)
    {
        $division = Division::find($id);
        return response()->json($division);
    }

    public function destroy($id)
    {
        $check = Employee::where('division_id', $id)->count();
        if($check != 0){
            return response()->json(['error'=>'Division has been used.']);
        }else {
            Division::find($id)->delete();
            return response()->json(['response'=>'Division deleted successfully.']);
        }
    }
}
