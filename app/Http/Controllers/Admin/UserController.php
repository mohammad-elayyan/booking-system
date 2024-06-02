<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ]);

        if ($validator->fails())
            return response()->json([$validator->errors()->toJson()]);

        User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
        return response()->json('User is added');
    }
}
