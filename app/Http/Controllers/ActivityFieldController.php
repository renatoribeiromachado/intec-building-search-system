<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityFieldRequest;
use App\Http\Requests\UpdateActivityFieldRequest;
use App\Models\ActivityField;

class ActivityFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityFieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityFieldRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function show(ActivityField $activityField)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityField $activityField)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityFieldRequest  $request
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityFieldRequest $request, ActivityField $activityField)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityField $activityField)
    {
        //
    }
}
