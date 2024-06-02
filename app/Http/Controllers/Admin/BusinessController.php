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
            'name' => 'required',
            'user_id' => 'required',
            'opening_hours' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        Business::create(array_merge($validator->validated()));
        return response()->json('business added');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all, [
            'name' => 'required',
            'user_id' => 'required',
            'opening_hours' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails())
            return response()->json([$validator->errors()->toJson()]);

        $business = Business::findOrFail($id);
        $business->update($validator->validated());

        return response()->json('business updated');
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        return response()->json('business deleted');
    }
}
