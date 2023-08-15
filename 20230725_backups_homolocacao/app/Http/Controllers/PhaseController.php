<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhaseRequest;
use App\Http\Requests\UpdatePhaseRequest;
use App\Models\Phase;

class PhaseController extends Controller
{
    protected $phase;

    public function __construct(
        Phase $phase
    ) {
        $this->phase = $phase;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phases = $this->phase->allPhases();
        return view('layouts.phase.index', compact('phases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phase = $this->phase;
        return view('layouts.phase.create', compact('phase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhaseRequest $request)
    {
        $phase = $this->phase;
        $phase->description = $request->description;
        $phase->save();

        return redirect()->route('phase.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function edit(Phase $phase)
    {
        return view('layouts.phase.edit', compact('phase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhaseRequest  $request
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhaseRequest $request, Phase $phase)
    {
        $phase->description = $request->description;
        $phase->save();

        return redirect()->route('phase.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phase  $phase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phase $phase)
    {
        $phase->delete();
        return redirect()->route('phase.index');
    }
}
