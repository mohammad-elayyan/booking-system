<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('service')
            ->paginate(10);
        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'service_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());
       
        $bookings = new Booking();
        $bookings->time = $request->time;
        $bookings->user_id = Auth::id();
        $bookings->service_id = $request->service_id;

        $bookings->save();
        return response()->json('Booking is added');
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'service_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors()->toJson());
       
            $bookings = Booking::where('id',$id)->firstOrFail();
            $bookings->time = $request->time;
            $bookings->save();
            return response()->json('Booking is updated');
    }

    public function destroy($id){
        $bookings = Booking::where('id',$id)->firstOrFail();
        $bookings->delete();
        return response()->json('Booking is deleted');
    }
}
