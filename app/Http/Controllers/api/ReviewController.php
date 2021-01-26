<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewCollection;
use App\Models\Bookable;
use App\Models\Booking;
use App\Models\Review;
use App\Http\Resources\Review\Review as ReviewResource;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Bookable $bookable
     * @return ReviewCollection
     */
    public function index(Bookable $bookable)
    {
        return new ReviewCollection($bookable->reviews()->latest()->get());
    }

    public function show(Review $review)
    {
        return new ReviewResource($review);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'rating' => 'required|in:1,2,3,4,5',
            'content' => 'required'
        ]);

        $booking = Booking::where('review_key',$request->input('id'))->firstOrFail();

        $booking->review()->create([
            'id' => $request->input('id'),
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
            'bookable_id' => $booking->bookable->id
        ]);

        $booking->review_key = null ;
        $booking->save();

        return response()->json([
            'message' => 'review created successfully',
        ],201);
    }
}
