<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(10);
        return response()->json($reviews);
    }

    public function business_review($id)
    {
        $reviews = Review::where('business_id', $id)
            ->paginate(10);
        if (count($reviews) === 0)
            return response()->json(abort(404));

        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_id' => 'required',
            'review' => 'required|string',
            'stars' => 'required',
        ]);

        if ($validator->fails())
            return \response()->json($validator->errors()->toJson());

        $review = new Review();
        $review->user_id = Auth::id();
        $review->business_id = $request->business_id;
        $review->review = $request->review;
        $review->stars = $request->stars;
        $review->save();

        return response()->json("Review is added");
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|string',
            'stars' => 'required',
        ]);

        if ($validator->fails())
            return \response()->json($validator->errors()->toJson());

        $review =  Review::findOrFail($id);
        $review->review = $request->review;
        $review->stars = $request->stars;
        $review->save();

        return response()->json("Review is updated");
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json('Review is deleted');
    }
}
