<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Phase;
use App\Models\Work;
use Carbon\Carbon;

class WorkController extends Controller
{
    protected $work;
    protected $phase;

    public function __construct(
        Work $work,
        Phase $phase,
    ) {
        $this->work = $work;
        $this->phase = $phase;
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
        return view('layouts.work.create', compact(
            'work',
            'phases',
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
        $work->phase_id = $request->phase_id;
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
        return view('layouts.work.edit', compact(
            'phases',
            'work'
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
        $work->phase_id = $request->phase_id;
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
