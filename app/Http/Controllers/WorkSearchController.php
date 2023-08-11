<?php

namespace App\Http\Controllers;

use App\Models\Associate;
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

        // Data for all kind of Users
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();

        $authUser = Auth::user();

        if ($authUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $authUser->role->slug == Associate::ASSOCIATE_USER) {
            $statesVisible = $authUser->contact->company->associate->states()->get()->pluck('id');
            $segmentSubTypesVisible = $authUser->contact->company->associate->segmentSubTypes()->get()->pluck('id');
            
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

        if (Auth::user()->role->slug != Associate::ASSOCIATE_MANAGER &&
            Auth::user()->role->slug != Associate::ASSOCIATE_USER) {
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

        $startedAt = $request->last_review_from;
        $endsAt = $request->last_review_to;
        $allStageIds = $request->stages;
        $allStateIds = $request->states;
        $allSegmentSubTypeIds = $request->segment_sub_types;
        $investmentStandard = $request->investment_standard;

        if (! isset($startedAt) &&
            ! isset($endsAt) &&
            ! isset($allStageIds) &&
            ! isset($allStateIds) &&
            ! isset($allSegmentSubTypeIds) &&
            ! isset($investmentStandard)
        ) {
            return redirect()->route('work.search.step_one.index');
        }

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
        $loggedUser = Auth::user();
        $startedAt = $request->last_review_from;
        $endsAt = $request->last_review_to;
        $allStageIds = $request->stages;
        $allStateIds = $request->states;
        $allSegmentSubTypeIds = $request->segment_sub_types;
        $investmentStandard = $request->investment_standard;
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

        

        if ($loggedUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $loggedUser->role->slug == Associate::ASSOCIATE_USER) {
            $associate = $loggedUser->contact->company->associate;

            if ((! is_null($associate->data_filter_starts_at)) &&
                ! is_null($associate->data_filter_ends_at)) {

                $dataFilterStartsAt = convertPtBrDateToEnDate($associate->data_filter_starts_at);
                $dataFilterEndsAt = convertPtBrDateToEnDate($associate->data_filter_ends_at);

                $works = $works->whereBetween('works.last_review', [$dataFilterStartsAt, $dataFilterEndsAt]);
            }
        } elseif ($startedAt && $endsAt) {
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

        if ($investmentStandard) {
            $works = $works->where('works.investment_standard', $investmentStandard);
        }

        /**
         * The associate user only can search works based in the associate period fields:
         *
         *  - data_filter_starts_at and;
         *  - data_filter_ends_at.
         */
        if ($loggedUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $loggedUser->role->slug == Associate::ASSOCIATE_USER
        ) {
            $works = $works->whereBetween(
                'works.last_review', [
                    $loggedUser->contact->company->associate->data_filter_starts_at->format('Y-m-d'),
                    $loggedUser->contact->company->associate->data_filter_ends_at->format('Y-m-d')
                ]
            );
        }

        return $works->paginate(self::REGISTRIES_PER_PAGE);
    }
}
