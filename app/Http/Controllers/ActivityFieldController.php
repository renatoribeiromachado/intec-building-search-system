<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityFieldRequest;
use App\Http\Requests\UpdateActivityFieldRequest;
use App\Models\ActivityField;

class ActivityFieldController extends Controller
{
    protected $activityField;

    public function __construct(
        ActivityField $activityField
    ) {
        $this->activityField = $activityField;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityFields = $this->activityField->allActivityFields();
        return view('layouts.activity_field.index', compact('activityFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activityField = $this->activityField;
        return view('layouts.activity_field.create', compact(
            'activityField',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityFieldRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityFieldRequest $request)
    {
        $activityField = $this->activityField;
        $activityField->description = $request->description;
        $activityField->save();

        return redirect()->route('activity_field.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivityField $activityField)
    {
        return view('layouts.activity_field.edit', compact(
            'activityField',
        ));
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
        $activityField->description = $request->description;
        $activityField->save();

        return redirect()->route('activity_field.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ActivityField  $activityField
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityField $activityField)
    {
        $activityField->delete();
        return redirect()->back();
    }
}
