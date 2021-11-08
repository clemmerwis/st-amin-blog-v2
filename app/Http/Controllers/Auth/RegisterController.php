<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // rather than use "$this->validate",
        // instead use validator facade to capture validation instance in variable
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // "with" is for flash data
        // "withErrors" is for the validation error bag
        // with input allows form to use old('name') etc...
        if ($validator->fails()) {
            return back()
                ->with('register_error', 'Form data was not valid')
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // auth logic only included for future use if needed
        if ( auth()->attempt($request->only('email', 'password')) ) {
            if ( auth()->user()->is_admin ) {
                return redirect()->route('admin.dashboard');
            }
            else {
                return redirect()->route('user.profile');
            }
        }
        else {
            return redirect()->route('home')->with('register_error', 'Submitted form data was invalid');
        }
    }
}
