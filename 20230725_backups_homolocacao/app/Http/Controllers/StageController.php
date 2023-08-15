<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStageRequest;
use App\Http\Requests\UpdateStageRequest;
use App\Models\Phase;
use App\Models\Stage;

class StageController extends Controller
{
    protected $stage;
    protected $phase;

    public function __construct(
        Stage $stage,
        Phase $phase
    ) {
        $this->stage = $stage;
        $this->phase = $phase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stages = $this->stage->allStages();
        return view('layouts.stage.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stage = $this->stage;
        $phases = $this->phase->get();
        return view('layouts.stage.create', compact(
            'stage',
            'phases',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStageRequest $request)
    {
        $stage = $this->stage;
        $stage->description = $request->description;
        $stage->phase_id = $request->phase_id;
        $stage->save();

        return redirect()->route('stage.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        $phases = $this->phase->get();
        return view('layouts.stage.edit', compact(
            'stage',
            'phases',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStageRequest  $request
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStageRequest $request, Stage $stage)
    {
        $stage->description = $request->description;
        $stage->save();

        return redirect()->route('stage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        $stage->delete();
        return redirect()->route('stage.index');
    }
}
