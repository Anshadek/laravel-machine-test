<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('dashboard'));
        }
        // if unsuccessful, then redirect back to the login with the form data


        return redirect()->back()
            ->withErrors(["general" => "Email and password are wrong."])
            ->withInput($request->only('email', 'password', 'remember'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }

}
