<?php

namespace App\Http\Controllers;

use App\Exports\WorkSearchesExport;
use App\Http\Requests\WorkSearchStepTwoRequest;
use App\Models\Company;
use App\Models\Associate;
use App\Models\SegmentSubType;
use App\Models\Sig;
use App\Models\Stage;
use App\Models\State;
use App\Models\City;
use App\Models\Work;
use App\Models\WorkFeature;
use App\Models\Researcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class WorkSearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $stage;
    protected $work;
    protected $state;
    protected $city;
    protected $segmentSubType;
    protected $workFeature;
    protected $researcher;
    protected $sig;
    protected $worksSessionName = 'works_checkboxes';
    protected $stagesSessionName = 'stages_checkboxes';
    protected $segmentSubTypesSessionName = 'segment_sub_types_checkboxes';
    protected $statesSessionName = 'states_checkboxes';

    public function __construct(
        Stage $stage,
        Work $work,
        State $state,
        City $city,
        SegmentSubType $segmentSubType,
        WorkFeature $workFeature,
        Researcher $researcher,
        Sig $sig  
    ) {
        $this->stage = $stage;
        $this->work = $work;
        $this->state = $state;
        $this->city = $city;
        $this->segmentSubType = $segmentSubType;
        $this->workFeature = $workFeature;
        $this->researcher = $researcher;
        $this->sig = $sig;
    }

    public function showWorkSearchStepOne()
    {
        $this->authorize('ver-pesquisa-de-obras');

        $this->resetWorksSession();
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();
        $researchers = $this->researcher->get();//Renato machado 04/09/2023

        $authUser = Auth::user();

        if (authUserIsAnAssociate()) {

            $statesVisible = session('statesVisible');
            $segmentSubTypesVisible = session('segmentSubTypesVisible');
            
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

            $states = $this->state
                ->select('state_acronym', 'description')
                ->whereIn('id', $statesVisible)
                ->get()->pluck('description', 'state_acronym');
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

            $states = $this->state
                ->select('state_acronym', 'description')
                ->get()->pluck('description', 'state_acronym');
        }

        return view('layouts.work.search.step_one.index', compact(
            'stagesOne',
            'stagesTwo',
            'stagesThree',
            'states',
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
            'researchers'
        ));
    }

    public function showWorkSearchStepTwo(WorkSearchStepTwoRequest $request)
    {
        $authUser = Auth::user();
        $this->authorize('ver-pesquisa-de-obras');
        $reports = $this->sig->where('user_id',$authUser->id)->get();
        $works = $this->getFilteredWorks($request);
        $worksChecked = session($this->worksSessionName);
        $currentPage = is_null($request->page) ? 1 : $request->page;
        $btnExistsInSession = session()->has('btnSelectAll');
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        $loggedUser = Auth::user();

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

        $work2 = null;
        foreach($works as $work) {
            $work2 = $this->work->findOrFail($work->id);
            $lastSigStatus = optional($work2->sigs()
                ->where('user_id', '=', $loggedUser->id)
                ->get()->last())->status;
            $work->last_sig_status = $lastSigStatus;
        }

        $searchParams = $request->query();
        
        $worksTotal = number_format(
            $this->work->whereIn('phase_id', [1, 2])
               ->whereNull('deleted_at') // Adiciona a condição deleted_at IS NULL
               ->count(),0,'','.');

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
            'reports',
            'searchParams',
            'worksTotal'
        ));
    }

    public function showWorkSearchStepThree(Request $request)
    {
        $this->authorize('ver-pesquisa-de-obras');
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        
        $works = $this->getFilteredWorks($request);
        $workFeatures = $this->workFeature
            ->orderBy('description', 'asc')
            ->get();

        return view('layouts.work.search.step_three.index', compact(
            'works',
            'workFeatures',
            'statuses',
            'priorities'
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
        $statesVisible = session('statesVisible');
        $segmentSubTypesVisible = session('segmentSubTypesVisible');
        $startedAt = $request->last_review_from;
        $endsAt = $request->last_review_to;
        $name = $request->name;
        $investmentStandard = $request->investment_standard;
        $address = $request->address;
        $oldCode = $request->old_code;
        $district = $request->district;
        $stateAcronym = $request->state_id;
        $cityId = $request->cities_ids;
        $search = $request->search;
        $qi = $request->qi;
        $price = $request->price;
        $qr = $request->qr;
        $revision = $request->revision;
        $qa = $request->qa;
        $totalArea = $request->total_area;

        // State filter
        $allStateIds = null;
        $allStatesAcronym = null;
        $states = $this->state->select('state_acronym');
        $researcher = $request->researcher_id;

        if (session()->has($this->statesSessionName) || $request->states) {
            $allStateIds = session()->has($this->statesSessionName)
                ? session($this->statesSessionName)
                : $request->states;
        }

        if ((! session()->has('statesVisible')) && isset($allStateIds)) {
            $states = $states->whereIn('id', $allStateIds);
        }

        // the session 'statesVisible' exists only for associate manager or associate user,
        // this filter covers the situation where the user hasn't selected any states
        if (session()->has('statesVisible') && (! isset($allStateIds))) {
            $states = $states->whereIn('id', $statesVisible);
        }

        // this filter covers the situation where the associate manager or associate user
        // has selected at least one state
        if (session()->has('statesVisible') && isset($allStateIds)) {
            $statesToSearch = [];
            foreach (session('statesVisible') as $stateVisible) {
                if (in_array($stateVisible, $allStateIds)) {
                    array_push($statesToSearch, $stateVisible);
                }
            }
            $states = $states->whereIn('id', $statesToSearch);
        }

        $allStatesAcronym = $states->get()->pluck('state_acronym');
        // Ends State filter

        $works = $this->work
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
        
        /*Empresa participante*/
        if ($search) {
            $works = $works->whereHas('companies', function ($q) use ($search) {
                return $q->where(
                    'companies.trading_name', $search
                );
            });
        }

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

        // Segment Sub Types filters
        $allSegmentSubTypeIds = null;
        if (session()->has($this->segmentSubTypesSessionName) || $request->segment_sub_types) {
            $allSegmentSubTypeIds = session()->has($this->segmentSubTypesSessionName)
                ? session($this->segmentSubTypesSessionName)
                : $request->segment_sub_types;
        }

        if ((! session()->has('segmentSubTypesVisible')) && isset($allSegmentSubTypeIds)) {
            $works = $works->whereIn('segment_sub_types.id', $allSegmentSubTypeIds);
        }
        
        if (session()->has('segmentSubTypesVisible') && (! isset($allSegmentSubTypeIds))) {
            $works = $works
                ->whereIn('segment_sub_types.id', $segmentSubTypesVisible->toArray());
        }

        // this filter covers the situation where the associate manager or associate user
        // has selected at least one segment subtype
        if (session()->has('segmentSubTypesVisible') && isset($allSegmentSubTypeIds)) {
            $segmentSubTypeToSearch = [];
            foreach ($segmentSubTypesVisible as $segmentSubTypeVisible) {
                if (in_array($segmentSubTypeVisible, $allSegmentSubTypeIds)) {
                    array_push($segmentSubTypeToSearch, $segmentSubTypeVisible);
                }
            }
            $works = $works->whereIn('segment_sub_types.id', $segmentSubTypeToSearch);
        }
        // Ends Segment Sub Types filters

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
        
        /*City*/
//        if ($cityId) {
//            $city = $this->city->findOrFail($cityId);
//            $works = $works->where('works.city', 'LIKE', '%'.$city->description.'%');
//        }
        
        if ($cityId && $stateAcronym) {
            $cityIds = explode(',', $cityId);
            $cityDescriptions = $this->city->whereIn('id', $cityIds)->pluck('description')->toArray();
            $works = $works->whereIn('works.city', $cityDescriptions);
        }

        /* Investimento */
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
        if (authUserIsAnAssociate()) {
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
        
        /*Pesquisador*/
        if ($researcher) {
            $works = $works->where('works.created_by', '=', $researcher);
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

    public function export(Request $request)
    {
        $searchParams = $request->query();
        return Excel::download(
            new WorkSearchesExport(
                $searchParams,
                $this->work,
                $this->state,
                $this->city
            ),
            'pesquisa-de-obras.xlsx'
        );
    }
    
    /*auto-complerte fantasia obras/empresa*/
    public function getCompany(Request $request) {
        $query = $request->input('search');
        $companies = Company::select('id', 'trading_name') // Selecionar o ID e fantasy_name
                     ->where('trading_name', 'like', '%' . $query . '%')
                     ->limit(50) // Limite de resultados
                     ->get();

        return response()->json($companies);
    }
    /**/
    public function getCompanyName(Request $request) {
        $query = $request->input('searchCompany');
        $companies = Company::select('id', 'company_name') // Selecionar o ID e company_name
                     ->where('company_name', 'like', '%' . $query . '%')
                     ->limit(50) // Limite de resultados
                     ->get();

        return response()->json($companies);
    }
}
