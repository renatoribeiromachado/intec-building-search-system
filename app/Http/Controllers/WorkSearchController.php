<?php

namespace App\Http\Controllers;

use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\State;
use App\Models\Work;
use App\Models\WorkFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkSearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $stage;
    protected $work;
    protected $state;
    protected $segmentSubType;
    protected $workFeature;

    public function __construct(
        Stage $stage,
        Work $work,
        State $state,
        SegmentSubType $segmentSubType,
        WorkFeature $workFeature,
    ) {
        $this->stage = $stage;
        $this->work = $work;
        $this->state = $state;
        $this->segmentSubType = $segmentSubType;
        $this->workFeature = $workFeature;
    }

    public function showWorkSearchStepOne()
    {
        $this->authorize('ver-pesquisa-de-obras');

        if (Auth::user()->role->name == 'Associado') {
            $statesVisible = Auth::user()->contact->company->associate->states()->get()->pluck('id');
            $segmentSubTypesVisible = Auth::user()->contact->company->associate->segmentSubTypes()->get()->pluck('id');

            $stagesOne = $this->stage->where('phase_id', 1)->get();
            $stagesTwo = $this->stage->where('phase_id', 2)->get();
            $stagesThree = $this->stage->where('phase_id', 3)->get();

            $statesOne = $this->state
                ->where('zone_id', 1)
                ->whereIn('id', $statesVisible)
                ->get();
            $statesTwo = $this->state
                ->where('zone_id', 2)
                ->whereIn('id', $statesVisible)
                ->get();
            $statesThree = $this->state
                ->where('zone_id', 3)
                ->whereIn('id', $statesVisible)
                ->get();
            $statesFour = $this->state
                ->where('zone_id', 4)
                ->whereIn('id', $statesVisible)
                ->get();
            $statesFive = $this->state
                ->where('zone_id', 5)
                ->whereIn('id', $statesVisible)
                ->get();

            $segmentSubTypeOne = $this->segmentSubType
                ->where('segment_id', 1)
                ->whereIn('id', $segmentSubTypesVisible)
                ->get();
            $segmentSubTypeTwo = $this->segmentSubType
                ->where('segment_id', 2)
                ->whereIn('id', $segmentSubTypesVisible)
                ->get();
            $segmentSubTypeThree = $this->segmentSubType
                ->where('segment_id', 3)
                ->whereIn('id', $segmentSubTypesVisible)
                ->get();
        }

        if (Auth::user()->role->name != 'Associado') {
            $stagesOne = $this->stage->where('phase_id', 1)->get();
            $stagesTwo = $this->stage->where('phase_id', 2)->get();
            $stagesThree = $this->stage->where('phase_id', 3)->get();

            $statesOne = $this->state->where('zone_id', 1)->get();
            $statesTwo = $this->state->where('zone_id', 2)->get();
            $statesThree = $this->state->where('zone_id', 3)->get();
            $statesFour = $this->state->where('zone_id', 4)->get();
            $statesFive = $this->state->where('zone_id', 5)->get();

            $segmentSubTypeOne = $this->segmentSubType->where('segment_id', 1)->get();
            $segmentSubTypeTwo = $this->segmentSubType->where('segment_id', 2)->get();
            $segmentSubTypeThree = $this->segmentSubType->where('segment_id', 3)->get();
        }


        return view('layouts.work.search.step_one.index', compact(
            'stagesOne',
            'stagesTwo',
            'stagesThree',
            'statesOne',

            'statesOne',
            'statesTwo',
            'statesThree',
            'statesFour',
            'statesFive',

            'segmentSubTypeOne',
            'segmentSubTypeTwo',
            'segmentSubTypeThree',
        ));
    }

    public function showWorkSearchStepTwo(Request $request)
    {
        $this->authorize('ver-pesquisa-de-obras');

        $works = $this->getFilteredWorks($request);

        return view('layouts.work.search.step_two.index', compact('works'));
    }

    public function showWorkSearchStepThree(Request $request)
    {
        $this->authorize('ver-pesquisa-de-obras');
        
        $works = $this->getFilteredWorks($request);
        $workFeatures = $this->workFeature
            ->orderBy('description', 'asc')
            ->get();

        return view('layouts.work.search.step_three.index', compact(
            'works',
            'workFeatures'
        ));
    }

    private function getFilteredWorks(Request $request)
    {
        $startedAt = $request->last_review_from;
        $endsAt = $request->last_review_to;
        $allStageIds = $request->stages;
        $allStateIds = $request->states;
        $allSegmentSubTypeIds = $request->segment_sub_types;
        $allStatesAcronym = null;

        if ($allStateIds) {
            $states = $this->state
                ->select('state_acronym')
                ->whereIn('id', $allStateIds)
                ->get();
            $allStatesAcronym = $states->pluck('state_acronym');
        }

        $works = DB::table('works')
            ->select(
                'works.*',
                'phases.description AS phase_description',
                'stages.description AS stage_description',
                'segments.description AS segment_description',
                'segment_sub_types.description AS segment_sub_type_description',
            )
            ->join('phases', 'works.phase_id', '=', 'phases.id')
            ->join('stages', 'works.stage_id', '=', 'stages.id')
            ->join('segments', 'works.segment_id', '=', 'segments.id')
            ->join('segment_sub_types', 'works.segment_sub_type_id', '=', 'segment_sub_types.id');

        if ($startedAt && $endsAt) {
            $startedAt = convertPtBrDateToEnDate($startedAt);
            $endsAt = convertPtBrDateToEnDate($endsAt);
            $works = $works->whereBetween('works.last_review', [$startedAt, $endsAt]);
        }

        $allWorkIds = null;
        if ($request->works_selected) {
            $allWorkIds = $request->works_selected;
            $works = $works->whereIn('works.id', $allWorkIds);
        }

        if ($allStageIds) {
            $works = $works->whereIn('stages.id', $allStageIds);
        }

        if ($allStatesAcronym) {
            $works = $works->whereIn('works.state', $allStatesAcronym);
        }

        if ($allSegmentSubTypeIds) {
            $works = $works->whereIn('segment_sub_types.id', $allSegmentSubTypeIds);
        }

        return $works->paginate(self::REGISTRIES_PER_PAGE);
    }
}
