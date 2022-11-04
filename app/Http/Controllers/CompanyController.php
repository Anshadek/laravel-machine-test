<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name ;
                })
                ->addColumn('email ', function ($row) {
                    return $row->email;
                })
                ->addColumn('website ', function ($row) {
                    return $row->website;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('company.show', $row->id);
                    return getActions($row,$showUrl);
                })

                ->addColumn('logo', function ($row) {
                    $img = '<img src="' . URL::to('/').$row->image_url . '" >';
                    return $img;
                })

                ->rawColumns(['action','logo','name','email','website'])
                ->make(true);
        }


        return view('company.list', [
            'category_name' => 'company',
            'page_name' => 'company',
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.form', [
            'category_name' => 'company',
            'page_name' => 'company',
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
            'name' => 'required',
            "logo"  => "dimensions:min_width=200,min_height=200",
            'email'=>'email|unique:companies,email'
        );

        $messages = array(
            'logo.dimensions' => 'The logo must be at least 200 x 200 pixels!',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('company.create')
                ->withErrors($validator)
                ->with(['error_message' => 'Please provide valid data.'])
                ->withInput();
        } else {

                try {
                $input = $request->input();
                $date = Carbon::now();

                $imagePath = "";
                if ($request->hasfile('logo')) {
                    $timeInMilliseconds = $date->valueOf();

                    $photo = $request->file('logo');
                    $ext = $photo->getClientOriginalExtension();
                    $imageName = $timeInMilliseconds . '.' . $ext;
                    $imageUrl = $request->file('logo')->storeAs('/public/images/company', $imageName);
                    $imagePath = Storage::url($imageUrl);

                }


                $value = array(
                    'name' => $input['name'],
                    'image_url' => $imagePath,
                    'email' => $input['email'],
                    'website' => $input['website'],
                );

                $company = Company::create(
                    $value
                );

                return redirect()->route('company.index')->with(['success_message' => 'Successfully added',]);
            } catch (\Exception $e) {

                return redirect()
                    ->route('company.create')
                    ->withErrors($validator)
                    ->with(['error_message' => 'Something went wrong. Try Again.'])
                    ->withInput();
            }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('company.view', [
            'company' => Company::findOrFail($id),
            'category_name' => 'company',
            'page_name' => 'company',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

    return view('company.form', [
        'category_name' => 'company',
        'page_name' => 'company',
        'company' => $company,
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required',
            "logo"  => "dimensions:min_width=200,min_height=200",

            'email' => "email|unique:companies,email,$id",
        );

        $messages = array(
            'logo.dimensions' => 'The logo must be at least 200 x 200 pixels!',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()
                ->route('company.edit', ['company' => $id])
                ->withErrors($validator)
                ->with(['error_message' => 'Please provide valid data.'])
                ->withInput();
        } else {
            try {

                $input = $request->input();
                $date = Carbon::now();

                $imagePath = "";
                if ($request->hasfile('logo')) {
                    $timeInMilliseconds = $date->valueOf();

                    $photo = $request->file('logo');
                    $ext = $photo->getClientOriginalExtension();
                    $imageName = $timeInMilliseconds . '.' . $ext;
                    $imageUrl = $request->file('logo')->storeAs('/public/images/company', $imageName);
                    $imagePath = Storage::url($imageUrl);
                } else {
                    $imagePath = $input['old_image'];
                }

                $value = array(
                    'name' => $input['name'],
                    'image_url' => $imagePath,
                    'email' => $input['email'],
                    'website' => $input['website'],
                );
                Company::where('id', $id)->update($value);
                return redirect()->route('company.index')->with(['success_message' => 'Successfully updated',]);
            } catch (\Exception $e) {
                return redirect()
                    ->route('company.edit', ['company' => $id])
                    ->with(['error_message' => 'Something went wrong. Try Again.'])
                    ->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $do=Company::where('id',$id)->delete();
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
