<?php

namespace App\Http\Controllers\Api;

use App\Models\Employ;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GeneralController extends BaseController
{
    public function UserLogin (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {

            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('MyApp')->accessToken;

                $response = ['token' => $token,'message'=>'login successful message'];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function getEmployees(Request $request)
    {
        if(Auth::guard('api')->check()){
        $datas = Employ::all();
        if ($datas->isEmpty()) {
            return $this->sendError('No record found.');
        } else {
            $employees = array();
            foreach($datas as $data){
                $newCompete = array(
                    'name'=>$data->first_name.''.$data->last_name,
                    'email'=>$data->email,
                    'phone'=>$data->phone,
                    'company_name'=>$data->company->name,
                    'company_email'=>$data->company->email,
                    'company_logo'=>$data->company->image_url,
                    'company_website'=>$data->company->website,
            );
            array_push($employees, $newCompete);
            }
            $data['employees'] = $employees;
            return $this->sendResponse($data, 'Success');
        }
    }else{
        return $this->sendError('unauthenticated.!');
    }
}


}
