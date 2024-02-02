<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAsset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read-company' , ['only' => ['index','show']]);
        $this->middleware('can:create-company', ['only' => ['create','store']]);
        $this->middleware('can:update-company', ['only' => ['edit','update']]);
        $this->middleware('can:delete-company', ['only' => ['destroy']]);
    }

    public function index(Request $request){
        $page = "Master Data Company";

        if ($request->ajax()) {
            $data = Company::with('asset')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('no', function ($row) {
                        static $no = 0;
                        return ++$no;
                    })
                    ->addColumn('action', function($row){

                            $btn = '<a href="/companies/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm">Edit</a> ';
                            $btn = $btn. ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCompany">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('company.index', compact('page'));
    }

    public function create(){
        $page = "Create Data Company";
        return view('company.create',compact('page'));
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            "company_name" => "required",
            "email" => "required",
            "phone_number" => "required",
            "website" => "required",
            "address" => "required",
            "logo" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company =   Company::create(
                [
                    'company_name' => $request->company_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'website' => $request->website,
                    'address' => $request->address,
                    'description' => $request->description
                ]);

         if ($files = $request->file('logo')) {

            //delete old file
            File::delete('public/company/'.$request->logo);


            //insert new file
            $destinationPath = 'public/company/'; // upload path
            $filename = $request->company_name . '.' . $files->getClientOriginalExtension();
            $files->move($destinationPath, $filename);
            // $size = $request->file('asset')->getSize();
            $url = $destinationPath . $filename;

            CompanyAsset::create([
                'company_id' => $company->id,
                'file_name' => $filename,
                'url' => $url
            ]);
         }

        return redirect()->route('companies.index')
                        ->with('success','Company created successfully');

    }

    public function edit($id)
    {
        $company = Company::find($id);
        $asset = CompanyAsset::where("company_id", $id)->first();
        $page = "Edit Data Company";

        // dd($asset);
        return view('company.edit', compact('page', 'company', 'asset'));
    }

    public function update($id, Request $request){
        $rules = [
            "company_name" => "required",
            "email" => "required",
            "phone_number" => "required",
            "website" => "required",
            "address" => "required",
        ];

        $validatedData = $request->validate($rules);

        Company::where('id', $id)->update($validatedData);

         if ($files = $request->file('logo')) {

            //delete old file
            File::delete('public/company/'.$request->logo);
            CompanyAsset::where('company_id', $request->id)->delete();


            //insert new file
            $destinationPath = 'public/company/'; // upload path
            $filename = $request->company_name . '.' . $files->getClientOriginalExtension();
            $files->move($destinationPath, $filename);
            // $size = $request->file('asset')->getSize();
            $url = $destinationPath . $filename;

            CompanyAsset::create([
                'company_id' => $id,
                'file_name' => $filename,
                'url' => $url
            ]);
         }

        return redirect()->route('companies.index')
                        ->with('success','Update company successfully');
    }

    public function destroy($id)
    {
        Company::find($id)->delete();
        return response()->json(['response'=>'Company deleted successfully.']);
    }
}
