<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Review\ReviewCollection;
use App\Models\Bookable;

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
}
