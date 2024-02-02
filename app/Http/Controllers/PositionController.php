<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-position' , ['only' => ['index','show']]);
        $this->middleware('can:create-position', ['only' => ['create','store']]);
        $this->middleware('can:update-position', ['only' => ['edit','update']]);
        $this->middleware('can:delete-position', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $page = "Master Data Position";
        $company = Company::all();

        if ($request->ajax()) {
            $data = Position::with('company')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('no', function ($row) {
                        static $no = 0;
                        return ++$no;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPosition">Edit</a> ';
                            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePosition">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('position.index', compact('page', 'company'));
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            "company_id" => "required",
            "position_name" => "required"
        ]);

        Position::updateOrCreate(['id' => $request->id],
        ['company_id' => $request->company_id ,'position_name' => $request->position_name]);

        return response()->json(['success'=>'Position saved successfully.']);

    }

    public function edit($id)
    {
        $position = Position::find($id);
        return response()->json($position);
    }

    public function destroy($id)
    {
        $check = Employee::where('position_id', $id)->count();
        if($check != 0){
            return response()->json(['error'=>'Position has been used.']);
        }else {
            Position::find($id)->delete();
            return response()->json(['response'=>'Position deleted successfully.']);
        }
    }
}
