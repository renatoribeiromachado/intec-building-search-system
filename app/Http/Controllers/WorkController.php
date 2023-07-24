<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Phase;
use App\Models\Segment;
use App\Models\Work;
use Carbon\Carbon;

class WorkController extends Controller
{
    protected $work;
    protected $phase;
    protected $segment;

    public function __construct(
        Work $work,
        Phase $phase,
        Segment $segment,
    ) {
        $this->work = $work;
        $this->phase = $phase;
        $this->segment = $segment;
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
        $phases = $this->phase->allPhases();
        $segments = $this->segment->allSegments();
        return view('layouts.work.create', compact(
            'work',
            'phases',
            'segments',
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
        $work->segment_id = $request->segment_id;
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
        $segments = $this->segment->allSegments();
        return view('layouts.work.edit', compact(
            'phases',
            'work',
            'segments',
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
        $work->segment_id = $request->segment_id;
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
