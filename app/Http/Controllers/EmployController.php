<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employ;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class EmployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employ::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {

                    return $row->first_name .' '.$row->last_name ;
                })
                ->addColumn('company', function ($row) {
                    return $row->company->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('phone', function ($row) {
                    return $row->phone;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('employ.show', $row->id);
                    return getActions($row,$showUrl);
                })
                ->rawColumns(['action','name','email','phone'])
                ->make(true);
        }


        return view('employ.list', [
            'category_name' => 'employ',
            'page_name' => 'employ',
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id','name')->get();
        return view('employ.form', [
            'category_name' => 'employ',
            'page_name' => 'employ',
            'companies' =>  $companies ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            "compani_id"  => "required",
            'email'=>'email|unique:employs,email'
        );

        $messages = array(
            'compani_id.required' => 'company required',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('employ.create')
                ->withErrors($validator)
                ->with(['error_message' => 'Please provide valid data.'])
                ->withInput();
        } else {

                try {
                $input = $request->input();

                $value = array(
                    'compani_id' => $input['compani_id'],
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],

                );

                $employ = Employ::create(
                    $value
                );

                return redirect()->route('employ.index')->with(['success_message' => 'Successfully added',]);
            } catch (\Exception $e) {

                return redirect()
                    ->route('employ.create')
                    ->withErrors($validator)
                    ->with(['error_message' => 'Something went wrong. Try Again.'])
                    ->withInput();
           }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('employ.view', [
            'employ' => employ::findOrFail($id),
            'category_name' => 'employ',
            'page_name' => 'employ',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employ = Employ::find($id);
        $companies = Company::select('id','name')->get();
    return view('employ.form', [
        'category_name' => 'employ',
        'page_name' => 'employ',
        'companies' => $companies,
        'employ' => $employ,
    ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            "compani_id"  => "required",
            'email' => "email|unique:employs,email,$id",
        );

        $messages = array(
            'compani_id.required' => 'company required',
        );


        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('employ.edit', ['employ' => $id])
                ->withErrors($validator)
                ->with(['error_message' => 'Please provide valid data.'])
                ->withInput();
        } else {
            try {

                $input = $request->input();

                $value = array(
                    'compani_id' => $input['compani_id'],
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],

                );
                Employ::where('id', $id)->update($value);
                return redirect()->route('employ.index')->with(['success_message' => 'Successfully updated',]);
            } catch (\Exception $e) {
                return redirect()
                    ->route('employ.edit', ['employ' => $id])
                    ->with(['error_message' => 'Something went wrong. Try Again.'])
                    ->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $do=Employ::where('id',$id)->delete();
        if ($do) {
            return response()->json(
                [
                    'message' => 'Successfully Deleted',
                ],
                201
            );
        } else {
            return response()->json(
                [
                    'message' => 'Something went wrong. Try Again.',
                ],
                400
            );
        }
    }
}
