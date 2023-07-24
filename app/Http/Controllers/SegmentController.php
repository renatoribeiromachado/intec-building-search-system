<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Models\Segment;

class SegmentController extends Controller
{
    protected $segment;

    public function __construct(
        Segment $segment
    ) {
        $this->segment = $segment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $segments = $this->segment->allSegments();
        return view('layouts.segment.index', compact('segments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $segment = $this->segment;
        return view('layouts.segment.create', compact('segment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSegmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSegmentRequest $request)
    {
        $segment = $this->segment;
        $segment->description = $request->description;
        $segment->save();

        return redirect()->route('segment.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function edit(Segment $segment)
    {
        return view('layouts.segment.edit', compact('segment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSegmentRequest  $request
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSegmentRequest $request, Segment $segment)
    {
        $segment->description = $request->description;
        $segment->save();

        return redirect()->route('segment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segment  $segment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segment $segment)
    {
        $segment->delete();
        return redirect()->route('segment.index');
    }
}
