<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentSubTypeRequest;
use App\Http\Requests\UpdateSegmentSubTypeRequest;
use App\Models\Segment;
use App\Models\SegmentSubType;

class SegmentSubTypeController extends Controller
{
    protected $segment;
    protected $segmentSubType;

    public function __construct(
        Segment $segment,
        SegmentSubType $segmentSubType
    ) {
        $this->segment = $segment;
        $this->segmentSubType = $segmentSubType;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $segmentSubTypes = $this->segmentSubType->allSegmentSubTypes();
        return view('layouts.segment_sub_type.index', compact('segmentSubTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $segments = $this->segment->get();
        $segmentSubType = $this->segmentSubType;
        return view('layouts.segment_sub_type.create', compact(
            'segments',
            'segmentSubType',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSegmentSubTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSegmentSubTypeRequest $request)
    {
        $segmentSubType = $this->segmentSubType;
        $segmentSubType->description = $request->description;
        $segmentSubType->segment_id = $request->segment_id;
        $segmentSubType->save();

        return redirect()->route('segment_sub_type.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SegmentSubType  $segmentSubType
     * @return \Illuminate\Http\Response
     */
    public function edit(SegmentSubType $segmentSubType)
    {
        $segments = $this->segment->get();
        return view('layouts.segment_sub_type.edit', compact(
            'segments',
            'segmentSubType',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSegmentSubTypeRequest  $request
     * @param  \App\Models\SegmentSubType  $segmentSubType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSegmentSubTypeRequest $request, SegmentSubType $segmentSubType)
    {
        $segmentSubType->description = $request->description;
        $segmentSubType->segment_id = $request->segment_id;
        $segmentSubType->save();

        return redirect()->route('segment_sub_type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SegmentSubType  $segmentSubType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SegmentSubType $segmentSubType)
    {
        $segmentSubType->delete();
        return redirect()->route('segment_sub_type.index');
    }
}
