<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceCotroller extends Controller
{
    public function index()
    {
        $business = Business::where('user_id', Auth::id())->firstOrFail();
        $services = Service::where('business_id', $business->id)->paginate(10);
        return response()->json($services);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'price' => 'required|string',

        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        $business = Business::where('user_id', Auth::id())->firstOrFail();

        $service = new Service();
        $service->business_id = $business->id;
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->save();

        return response()->json('Service is added');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|string',

            'price' => 'required|string',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->toJson());

        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->save();
        return response()->json('Service is updated');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json('Service is deleted');
    }
}
