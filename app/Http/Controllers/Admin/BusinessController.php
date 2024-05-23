<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function index()
    {
        $business = Business::paginate(10);
        return response()->json($business);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'user_id' => 'required|string',
            'opening_hours' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        Business::create(array_merge($validator->validated()));
        return response()->json('Business is added');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'user_id' => 'required|string',
            'opening_hours' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        $business = Business::findOrFail($id);
        $business->update(array_merge($validator->validated()));

        return response()->json('Business is updated');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        return response()->json('Business is deleted');
    }
}
