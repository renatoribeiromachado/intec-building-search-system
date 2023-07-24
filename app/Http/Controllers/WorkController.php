<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Phase;
use App\Models\Segment;
use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\Work;
use Carbon\Carbon;

class WorkController extends Controller
{
    protected $work;
    protected $phase;
    protected $stage;
    protected $segment;
    protected $segmentSubType;

    /*RFenato*/
    public function __construct(
        Work $work,
        Phase $phase,
        Stage $stage,
        Segment $segment,
        SegmentSubType $segmentSubType
    ) 
    {
        $this->work = $work;
        $this->phase = $phase;
        $this->stage = $stage;
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
        $works = $this->work->allWorks();
        return view('layouts.work.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work = $this->work;
        $phases = $this->phase->get();
        $segments = $this->segment->get();
        $segmentSubTypes = [];
        $stages = [];

        return view('layouts.work.create', compact(
            'work',
            'segments',
            'segmentSubTypes',
            'phases',
            'stages',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkRequest $request)
    {
        $work = $this->work;
        $work->old_code = $request->old_code;
        $work->last_review = convertPtBrDateToEnDate($request->last_review);
        $work->name = $request->name;
        $work->price = $request->price;
        $work->address = $request->address;
        $work->number = $request->number;
        $work->district = $request->district;
        $work->city = $request->city;
        $work->state = $request->state;
        $work->state_acronym = $request->state_acronym;
        $work->zip_code = $request->zip_code;
        $work->phase_id = $request->phase_id;
        $work->stage_id = $request->stage_id;
        $work->segment_id = $request->segment_id;
        $work->segment_sub_type_id = $request->segment_sub_type_id;
        $work->started_at = convertPtBrDateToEnDate($request->started_at);
        $work->ends_at = convertPtBrDateToEnDate($request->ends_at);
        $work->notes = $request->notes;
        $work->created_by = auth()->guard('web')->user()->id;
        $work->updated_by = auth()->guard('web')->user()->id;
        $work->save();

        return redirect()->route('work.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $phases = $this->phase->get();
        $segments = $this->segment->get();
        $segmentSubTypes = $this->segmentSubType
            ->where('segment_id', $work->segment_id)
            ->get();
        $stages = $this->stage
        ->where('phase_id', $work->phase_id)
        ->get();
            
        return view('layouts.work.edit', compact(
            'work',
            'segments',
            'segmentSubTypes',
            'phases',
            'stages',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkRequest  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        $work->old_code = $request->old_code;
        $work->last_review = convertPtBrDateToEnDate($request->last_review);
        $work->name = $request->name;
        $work->price = $request->price;
        $work->address = $request->address;
        $work->number = $request->number;
        $work->district = $request->district;
        $work->city = $request->city;
        $work->state = $request->state;
        $work->state_acronym = $request->state_acronym;
        $work->zip_code = $request->zip_code;
        $work->phase_id = $request->phase_id;
        $work->stage_id = $request->stage_id;
        $work->segment_id = $request->segment_id;
        $work->segment_sub_type_id = $request->segment_sub_type_id;
        $work->started_at = convertPtBrDateToEnDate($request->started_at);
        $work->ends_at = convertPtBrDateToEnDate($request->ends_at);
        $work->notes = $request->notes;
        $work->updated_by = auth()->guard('web')->user()->id;
        $work->save();

        return redirect()->route('work.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->delete();
        return redirect()->route('work.index');
    }
}
