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

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|string',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        User::create(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
        return response()->json('User is added');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        $user = User::findOrFail($id);
        $user->update(array_merge($validator->validated(), ['password' => bcrypt($request->password)]));
        return response()->json('User is updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('User is deleted');
    }
}
