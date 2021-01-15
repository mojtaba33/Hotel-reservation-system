<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bookable\Bookable as BookableResource;
use App\Http\Resources\Bookable\BookableCollection;
use App\Models\Bookable;
use Illuminate\Http\Request;

class BookableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BookableCollection
     */
    public function index()
    {
        return new BookableCollection(Bookable::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookable  $bookable
     * @return BookableResource
     */
    public function show(Bookable $bookable)
    {
        return new BookableResource(Bookable::findOrFail($bookable));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookable  $bookable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookable $bookable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookable  $bookable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookable $bookable)
    {
        //
    }
}
