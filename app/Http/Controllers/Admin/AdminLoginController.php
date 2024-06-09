<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('user');
                // $token = $user->createToken('authToken')->plainTextToken;
                // return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
            } else {

                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }
        return redirect()->route('login_form');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login_form');
    }
}
