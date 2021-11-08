<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // rather than use "$this->validate",
        // instead use validator facade to capture validation instance in variable
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // "with" is for flash data
        // "withErrors" is for the validation error bag
        // with input allows form to use old('name') etc...
        if ($validator->fails()) {
            return back()
                ->with('login_error', 'Email and/or Password are wrong')
                ->withErrors($validator)
                ->withInput();
        }

        if ( auth()->attempt($request->only('email', 'password')) ) {
            if ( auth()->user()->is_admin ) {
                return redirect()->route('admin.dashboard');
            }
            else {
                return redirect()->route('user.profile');
            }
        }
        else {
            return redirect()->route('home')->with('login_error', 'Email and password are wrong');
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect('home');
    }
}
