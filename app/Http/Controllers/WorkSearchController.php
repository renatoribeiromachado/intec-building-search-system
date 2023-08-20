<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkSearchStepTwoRequest;
use App\Models\Associate;
use App\Models\SegmentSubType;
use App\Models\Sig;
use App\Models\Stage;
use App\Models\State;
use App\Models\StateCity;
use App\Models\City;
use App\Models\Work;
use App\Models\WorkFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class WorkSearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $stage;
    protected $work;
    protected $state;
    protected $state_city;
    protected $city;
    protected $segmentSubType;
    protected $workFeature;
    protected $worksSessionName = 'works_checkboxes';
    protected $stagesSessionName = 'stages_checkboxes';
    protected $segmentSubTypesSessionName = 'segment_sub_types_checkboxes';
    protected $statesSessionName = 'states_checkboxes';

    public function __construct(
        Stage $stage,
        Work $work,
        State $state,
        StateCity $state_city,
        City $city,
        SegmentSubType $segmentSubType,
        WorkFeature $workFeature,
    ) {
        $this->stage = $stage;
        $this->work = $work;
        $this->state = $state;
        $this->state_city = $state_city;
        $this->city = $city;
        $this->segmentSubType = $segmentSubType;
        $this->workFeature = $workFeature;
    }

    public function showWorkSearchStepOne()
    {
        $this->authorize('ver-pesquisa-de-obras');

        $this->resetWorksSession();
        $states = $this->state_city->all();
        $cities = $this->city->all();
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();

        $authUser = Auth::user();

        if ($authUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $authUser->role->slug == Associate::ASSOCIATE_USER) {

            $statesVisible = $authUser->contact->company->associate->states()->get()->pluck('id');
            $segmentSubTypesVisible = $authUser->contact->company->associate->segmentSubTypes()->get()->pluck('id');
            $statesVisible = $authUser->contact->company->associate->states()->get()->pluck('id');
            $segmentSubTypesVisible = $authUser->contact->company->associate->segmentSubTypes()->get()->pluck('id');
            /*Todos os estados*/
            $states = $this->state_city->all();
            $cities = $this->city->all();
            
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

        if ($authUser->role->slug != Associate::ASSOCIATE_MANAGER &&
            $authUser->role->slug != Associate::ASSOCIATE_USER) {
            $statesOne = $this->state->where('zone_id', 1)->get();
            $statesTwo = $this->state->where('zone_id', 2)->get();
            $statesThree = $this->state->where('zone_id', 3)->get();
            $statesFour = $this->state->where('zone_id', 4)->get();
            $statesFive = $this->state->where('zone_id', 5)->get();

            $segmentSubTypeOne = $this->segmentSubType->where('segment_id', 1)->get();
            $segmentSubTypeTwo = $this->segmentSubType->where('segment_id', 2)->get();
            $segmentSubTypeThree = $this->segmentSubType->where('segment_id', 3)->get();
        }

        $states = $this->state
            ->select('state_acronym', 'description')
            ->get()->pluck('description', 'state_acronym');

        return view('layouts.work.search.step_one.index', compact(
            'stagesOne',
            'stagesTwo',
            'stagesThree',
            'states',
            'cities',
            'statesOne',
            'statesOne',
            'statesTwo',
            'statesThree',
            'statesFour',
            'statesFive',
            'segmentSubTypeOne',
            'segmentSubTypeTwo',
            'segmentSubTypeThree',
            'states',
        ));
    }

    public function showWorkSearchStepTwo(WorkSearchStepTwoRequest $request)
    {
        $this->authorize('ver-pesquisa-de-obras');

        $works = $this->getFilteredWorks($request);
        $worksChecked = session($this->worksSessionName);
        $currentPage = is_null($request->page) ? 1 : $request->page;
        $btnExistsInSession = session()->has('btnSelectAll');
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;

        $clickedInPage = $btnExistsInSession && session('btnSelectAll')['btn_clicked'] == 1
            ? session('btnSelectAll')['clicked_in_page']
            : $currentPage;

        $inputPageOfPagination = $currentPage;

        $inputSelectAll = $btnExistsInSession
            ? session('btnSelectAll')['btn_clicked']
            : 0;
        
        $statesChecked = [];
        if (! is_null(request()->states)) {
            request()->session()->put($this->statesSessionName, request()->states);
            $statesChecked = session($this->statesSessionName);
        }
        
        $segmentSubTypesChecked = [];
        if (! is_null(request()->segment_sub_types)) {
            request()->session()->put($this->segmentSubTypesSessionName, request()->segment_sub_types);
            $segmentSubTypesChecked = session($this->segmentSubTypesSessionName);
        }
        
        $stagesChecked = [];
        if (! is_null(request()->stages)) {
            request()->session()->put($this->stagesSessionName, request()->stages);
            $stagesChecked = session($this->stagesSessionName);
        }

        return view('layouts.work.search.step_two.index', compact(
            'works',
            'worksChecked',
            'statesChecked',
            'segmentSubTypesChecked',
            'stagesChecked',
            'clickedInPage',
            'inputPageOfPagination',
            'inputSelectAll',
            'statuses',
            'priorities',
        ));
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

    public function checkAllInputs(Request $request)
    {
        $onlyWorksSelectedIds = $request->work_ids;
        $inputSelectAllWasClicked = (bool) $request->input_select_all_was_clicked;
        $clickedInPage = $request->clicked_in_page;
        $inputPageOfPagination = $request->input_page_of_pagination;
        
        if (! session()->has($this->worksSessionName)) {
            request()->session()->put(
                $this->worksSessionName,
                $onlyWorksSelectedIds
            );

            request()->session()->put(
                'btnSelectAll', [
                    'btn_clicked' => 1,
                    'page_of_pagination' => $inputPageOfPagination,
                    'clicked_in_page' => $clickedInPage
                ]
            );
        } elseif (session()->has($this->worksSessionName)) {
            request()->session()->forget(
                $this->worksSessionName
            );
            request()->session()->put(
                $this->worksSessionName,
                $onlyWorksSelectedIds
            );

            request()->session()->forget(
                'btnSelectAll'
            );
            request()->session()->put(
                'btnSelectAll', [
                    'btn_clicked' => 0,
                    'page_of_pagination' => $inputPageOfPagination,
                    'clicked_in_page' => $inputSelectAllWasClicked
                        ? $clickedInPage
                        : $inputPageOfPagination
                ]
            );
        }

        return response()->json(
            ['works_selected' => $onlyWorksSelectedIds],
            Response::HTTP_OK
        );
    }

    private function getFilteredWorks(Request $request)
    {
        $loggedUser = Auth::user();
        $startedAt = $request->last_review_from;
        $endsAt = $request->last_review_to;
        $name = $request->name;
        $investmentStandard = $request->investment_standard;
        $address = $request->address;
        $oldCode = $request->old_code;
        $district = $request->district;
        $stateAcronym = $request->state_id;
        $state = $request->state;
        $city = $request->city;
        // $initial_zip_code = $request->initial_zip_code;
        // $final_zip_code = $request->final_zip_code;
        // $notes = $request->notes;
        
        $qi = $request->qi;
        $price = $request->price;
        
        $qr = $request->qr;
        $revision = $request->revision;
        
        $qa = $request->qa;
         

        $allStateIds = null;
        $allStatesAcronym = null;
        if (session()->has($this->statesSessionName) || $request->states) {
            $allStateIds = session()->has($this->statesSessionName)
                ? session($this->statesSessionName)
                : $request->states;

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

        $allWorkIds = null;
        if (
            (session()->has($this->worksSessionName) || $request->works_selected)
            && (! Route::is('work.search.step_two.index'))
        ) {
            $allWorkIds = session()->has($this->worksSessionName)
                ? session($this->worksSessionName)
                : $request->works_selected;
            $works = $works->whereIn('works.id', $allWorkIds);
        }

        if ($allStatesAcronym) {
            $works = $works->whereIn('works.state', $allStatesAcronym);
        }

        $allStageIds = null;
        if (session()->has($this->stagesSessionName) || $request->stages) {
            $allStageIds = session()->has($this->stagesSessionName)
                ? session($this->stagesSessionName)
                : $request->stages;
            $works = $works->whereIn('stages.id', $allStageIds);
        }

        $allSegmentSubTypeIds = null;
        if (session()->has($this->segmentSubTypesSessionName) || $request->segment_sub_types) {
            $allSegmentSubTypeIds = session()->has($this->segmentSubTypesSessionName)
                ? session($this->segmentSubTypesSessionName)
                : $request->segment_sub_types;
            $works = $works->whereIn('segment_sub_types.id', $allSegmentSubTypeIds);
        }

        /*Nome da Obra*/
        if ($name) {
            $works = $works->where('works.name', 'LIKE', '%'.$name.'%');
        }
        
        /*Padrão investimento*/
        if ($investmentStandard) {
            $works = $works->where('works.investment_standard', $investmentStandard);
        }
        
        /*Endereço*/
        if ($address) {
            $works = $works->where('works.address', 'LIKE', '%'.$address.'%');
        }
        
        /*Código da obra*/
        if ($oldCode) {
            $oldCodes = explode(',', $oldCode); // Transforma a string de códigos em um array
            $works = $works->whereIn('works.old_code', $oldCodes);
        }
        
        /*Bairro*/
        if ($district) {
            $works = $works->where('works.district', 'LIKE', '%'.$district.'%');
        }

        /*State*/
        if ($stateAcronym) {
            $works = $works->where('works.state', '=', $stateAcronym);
        }
        
        /*Cidade*/
        if ($state) {
            $works = $works->where('works.state', 'LIKE', '%'.$state.'%');
        }
        
        /*Cidade*/
        if ($city) {
            $works = $works->where('works.city', 'LIKE', '%'.$city.'%');
        }
        
        // /*CEP*/
        // if ($initial_zip_code && $final_zip_code) {
        //     $works = $works->whereBetween('works.zip_code', [$initial_zip_code, $final_zip_code]);
        // }
        
        // /*Codigo da obra*/
        // if ($notes) {
        //     $notes = $works->where('works.notes', $notes);
        // }
        
        /* Investimento */
        $qi = $request->input('qi');
        $price = $request->input('price');

        if ($qi && $price !== null) {
            // Convertendo valor monetário do formato brasileiro para numérico
            $price = str_replace(['.', ','], ['', '.'], $price);

            $works = $works->where(function($query) use ($qi, $price) {
                if ($qi == '>') {
                    $query->where('works.price', '>', $price);
                } elseif ($qi == '<') {
                    $query->where('works.price', '<', $price);
                }
            });
        }

        /* Revision */
        $qr = $request->input('qr');
        $revision = $request->input('revision');

        if ($qr && $revision !== null) {
            $works = $works->where(function($query) use ($qr, $revision) {
                if ($qr == '>') {
                    $query->where('works.revision', '>=', $revision);
                } elseif ($qr == '<') {
                    $query->where('works.revision', '<=', $revision);
                }
            });
        }
        
        /* Área Construída */
        $qa = $request->input('qa');
        $totalArea = $request->input('total_area');

        if ($qa && $totalArea !== null) {
            $works = $works->where(function($query) use ($qa, $totalArea) {
                if ($qa == '>') {
                    $query->where('works.total_area', '>', $totalArea);
                } elseif ($qa == '<') {
                    $query->where('works.total_area', '<', $totalArea);
                }
            });
        }

        /**
         * The associate user only can search works based in the associate period fields:
         *
         *  - data_filter_starts_at and;
         *  - data_filter_ends_at.
         */
        $dataFilterStartsAtFinal = $startedAt;
        $dataFilterEndsAtFinal = $endsAt;
        if ($loggedUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $loggedUser->role->slug == Associate::ASSOCIATE_USER) {

            $dataFilterStartsAt1 = $loggedUser->contact->company->associate->data_filter_starts_at->format('Y-m-d');
            $dataFilterEndsAt1 = $loggedUser->contact->company->associate->data_filter_ends_at->format('Y-m-d');

            // Final criteria initialization.
            $dataFilterStartsAtFinal = $dataFilterStartsAt1;
            $dataFilterEndsAtFinal = $dataFilterEndsAt1;

            // Date verification informed by associate members
            if ($startedAt && $endsAt) {

                // Filter dt ini >= $dataFilterStartsAt1? yes, so it is on the associate period range
                $dataFilterStartsAtFinal = ($startedAt >= $dataFilterStartsAt1)
                    ? $startedAt
                    : $dataFilterStartsAt1;

                // Filter dt end <= $dataFilterEndsAt1? yes, so it is on the associate period range
                $dataFilterEndsAtFinal = ($endsAt <= $dataFilterEndsAt1)
                    ? $endsAt
                    : $dataFilterEndsAt1;
            }
        }

        if ($dataFilterStartsAtFinal || $dataFilterEndsAtFinal) {
            $works = $works->whereBetween(
                'works.last_review', [$dataFilterStartsAtFinal, $dataFilterEndsAtFinal]
            );
        }

        if (Route::is('work.search.step_three.index')) {
            return $works->get();
        }

        return $works->paginate(self::REGISTRIES_PER_PAGE);
    }

    private function resetWorksSession(): void
    {
        request()->session()->forget([
            $this->worksSessionName,
            $this->stagesSessionName,
            $this->segmentSubTypesSessionName,
            $this->statesSessionName,
            'btnSelectAll'
        ]);
    }

    public function pushWorksSession(Request $request)
    {
        $worksChecked = [];
        if (session()->has($this->worksSessionName)){
            $worksChecked = session()->get($this->worksSessionName);
        }

        $worksChecked = array_merge($worksChecked, [request()->work]);

        request()->session()->put($this->worksSessionName, $worksChecked);

        return response()->json(
            ['works' => session($this->worksSessionName)],
            Response::HTTP_OK
        );
    }

    public function removeWorksSession(Request $request)
    {
        $selectedWorks = session($this->worksSessionName);

        if (($key = array_search(request()->work, $selectedWorks)) !== false) {
            unset($selectedWorks[$key]);
            $selectedWorks = array_values($selectedWorks);
        }
        
        request()->session()->put($this->worksSessionName, $selectedWorks);

        return response()->json(
            ['works' => session($this->worksSessionName)],
            Response::HTTP_OK
        );
    }
    
    /*Pega as cidades pelo id do estsado*/
    public function getCitiesByState($stateId)
    {
        // Aqui você precisa implementar a lógica para buscar as cidades com base no estado
        // Suponhamos que você tenha um modelo City com um relacionamento para o estado
        $cities = $this->city->where('uf', $stateId)->get();

        return response()->json(['cities' => $cities]);
    }
}
