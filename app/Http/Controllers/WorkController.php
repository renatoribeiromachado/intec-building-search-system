<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Phase;
use App\Models\Segment;
use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class WorkController extends Controller
{
    protected $work;
    protected $phase;
    protected $stage;
    protected $segment;
    protected $segmentSubType;
    protected $researcher;

    public function __construct(
        Work $work,
        Phase $phase,
        Stage $stage,
        Segment $segment,
        SegmentSubType $segmentSubType,
        User $researcher
    ) {
        $this->work = $work;
        $this->phase = $phase;
        $this->stage = $stage;
        $this->segment = $segment;
        $this->segmentSubType = $segmentSubType;
        $this->researcher = $researcher;
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
        $researchers = $this->researcher
            ->whereHas('role', function (Builder $query) {
                $query->where('name', '=', 'Pesquisador');
            })->get();

        return view('layouts.work.create', compact(
            'work',
            'segments',
            'segmentSubTypes',
            'phases',
            'stages',
            'researchers',
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

        $work->revision = $request->revision;
        $work->start_and_end = $request->start_and_end;
        $work->total_project_area = $request->total_project_area;
        $work->cub = $request->cub;
        $work->quotation_type = $request->quotation_type;
        $work->coin = $request->coin;
        $work->investment_standard = $request->investment_standard;

        $work->tower = $request->tower;
        $work->house = $request->house;
        $work->condominium = $request->condominium;
        $work->floor = $request->floor;
        $work->apartment_per_floor = $request->apartment_per_floor;
        $work->bedroom = $request->bedroom;
        $work->suite = $request->suite;
        $work->bathroom = $request->bathroom;
        $work->washbasin = $request->washbasin;
        $work->living_room = $request->living_room;
        $work->cup_and_kitchen = $request->cup_and_kitchen;
        $work->service_area_terrace_balcony = $request->service_area_terrace_balcony;
        $work->maid_dependency = $request->maid_dependency;
        $work->total_unities = $request->total_unities;
        $work->useful_area = $request->useful_area;
        $work->total_area = $request->total_area;
        $work->elevator = $request->elevator;
        $work->garage = $request->garage;
        $work->coverage = $request->coverage;
        $work->air_conditioner = $request->air_conditioner;
        $work->heating = $request->heating;
        $work->foundry = $request->foundry;
        $work->frame = $request->frame;
        $work->completion = $request->completion;
        $work->facade = $request->facade;
        $work->status = $request->status;

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

        $work->revision = $request->revision;
        $work->start_and_end = $request->start_and_end;
        $work->total_project_area = $request->total_project_area;
        $work->cub = $request->cub;
        $work->quotation_type = $request->quotation_type;
        $work->coin = $request->coin;
        $work->investment_standard = $request->investment_standard;

        $work->tower = $request->tower;
        $work->house = $request->house;
        $work->condominium = $request->condominium;
        $work->floor = $request->floor;
        $work->apartment_per_floor = $request->apartment_per_floor;
        $work->bedroom = $request->bedroom;
        $work->suite = $request->suite;
        $work->bathroom = $request->bathroom;
        $work->washbasin = $request->washbasin;
        $work->living_room = $request->living_room;
        $work->cup_and_kitchen = $request->cup_and_kitchen;
        $work->service_area_terrace_balcony = $request->service_area_terrace_balcony;
        $work->maid_dependency = $request->maid_dependency;
        $work->total_unities = $request->total_unities;
        $work->useful_area = $request->useful_area;
        $work->total_area = $request->total_area;
        $work->elevator = $request->elevator;
        $work->garage = $request->garage;
        $work->coverage = $request->coverage;
        $work->air_conditioner = $request->air_conditioner;
        $work->heating = $request->heating;
        $work->foundry = $request->foundry;
        $work->frame = $request->frame;
        $work->completion = $request->completion;
        $work->facade = $request->facade;
        $work->status = $request->status;

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
