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
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('create_user');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        if ($validator->fails())
            return response()->json([$validator->errors()->toJson()]);

        User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
        return redirect()->route('user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->password) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string|min:6',
                'role' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'role' => 'required'
            ]);
        }

        if ($validator->fails())
            return response()->json([$validator->errors()->toJson()]);

        dd($validator->getData()['name']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
