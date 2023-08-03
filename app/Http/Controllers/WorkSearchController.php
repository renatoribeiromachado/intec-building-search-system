<?php

namespace App\Http\Controllers;

use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\State;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkSearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $stage;
    protected $work;
    protected $state;
    protected $segmentSubType;

    public function __construct(
        Stage $stage,
        Work $work,
        State $state,
        SegmentSubType $segmentSubType,
    ) {
        $this->stage = $stage;
        $this->work = $work;
        $this->state = $state;
        $this->segmentSubType = $segmentSubType;
    }

    public function showWorkSearchStepOne()
    {
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
        $works = $this->getFilteredWorks($request);

        return view('layouts.work.search.step_two.index', compact('works'));
    }

    public function showWorkSearchStepThree(Request $request)
    {
        $works = $this->getFilteredWorks($request);

        return view('layouts.work.search.step_three.index', compact('works'));
    }

    private function getFilteredWorks(Request $request)
    {
        $startedAt = $request->started_at;
        $endsAt = $request->ends_at;
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
            $works = $works->where('works.started_at', '>=', $startedAt);
            $works = $works->where('works.ends_at', '<=', $endsAt);
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
