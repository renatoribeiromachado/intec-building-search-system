<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResearcherRequest;
use App\Http\Requests\UpdateResearcherRequest;
use App\Models\Researcher;

class ResearcherController extends Controller
{
    protected $researcher;

    public function __construct(
        Researcher $researcher
    ) {
        $this->researcher = $researcher;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $researchers = $this->researcher->allResearchers();
        return view('layouts.researcher.index', compact('researchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $researcher = $this->researcher;
        return view('layouts.researcher.create', compact('researcher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResearcherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResearcherRequest $request)
    {
        $researcher = $this->researcher;
        $researcher->name = $request->name;
        $researcher->created_by = auth()->user()->id;
        $researcher->updated_by = auth()->user()->id;
        $researcher->save();

        return redirect()->route('researcher.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function edit(Researcher $researcher)
    {
        return view('layouts.researcher.edit', compact('researcher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResearcherRequest  $request
     * @param  \App\Models\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResearcherRequest $request, Researcher $researcher)
    {
        $researcher->name = $request->name;
        $researcher->updated_by = auth()->user()->id;
        $researcher->save();

        return redirect()->route('researcher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Researcher  $researcher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Researcher $researcher)
    {
        $researcher->updated_by = auth()->user()->id;
        $researcher->save();
        $researcher->delete();
        return redirect()->route('researcher.index');
    }
}
