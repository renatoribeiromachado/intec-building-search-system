<?php

namespace App\Http\Controllers;

use App\Exports\CompanySearchesExport;
use App\Models\ActivityField;
use App\Models\Associate;
use App\Models\City;
use App\Models\Company;
use App\Models\SegmentSubType;
use App\Models\State;
use App\Models\Sig;
use App\Models\SigCompany;
use App\Traits\SelectCheckboxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class CompanySearchController extends Controller
{
    use SelectCheckboxes;

    const REGISTRIES_PER_PAGE = 50;

    protected $activityField;
    protected $company;
    protected $companiesSessionName = 'companies_checkboxes';
    protected $statesSessionName = 'states_checkboxes';
    protected $activityFieldsSessionName = 'activity_fields_checkboxes';
    protected $state;
    protected $city;
    protected $segmentSubType;
    protected $sigCompany;

    public function __construct(
        ActivityField $activityField,
        Company $company,
        State $state,
        City $city,
        SegmentSubType $segmentSubType,
        SigCompany $sigCompany
    ) {
        $this->activityField = $activityField;
        $this->company = $company;
        $this->state = $state;
        $this->city = $city;
        $this->segmentSubType = $segmentSubType;
        $this->sigCompany = $sigCompany;
    }

    public function showCompanySearchStepOne()
    {
        $this->resetCompaniesSession();

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get();

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

        return view('layouts.company.search.step_one.index', compact(
            'activityFields',
            'statesOne',
            'statesTwo',
            'statesThree',
            'statesFour',
            'statesFive',
            'segmentSubTypeOne',
            'segmentSubTypeTwo',
            'segmentSubTypeThree',
            'states'
        ));
    }

    public function showCompanySearchStepTwo(Request $request)
    {
        $companies = $this->getFilteredCompanies($request);
        $companiesChecked = session($this->companiesSessionName);
        $currentPage = is_null($request->page) ? 1 : $request->page;
        $btnExistsInSession = session()->has('btnSelectAll');
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        $loggedUser = Auth::user();
        $reports = $this->sigCompany->where('user_id',$loggedUser->id)->get();

        $clickedInPage = $btnExistsInSession
            && (session('btnSelectAll')['btn_clicked'] == 1)
            ? session('btnSelectAll')['clicked_in_page']
            : $currentPage;

        $inputPageOfPagination = $currentPage;

        $inputSelectAll = $btnExistsInSession
            ? session('btnSelectAll')['btn_clicked']
            : 0;

        $atLeastOneCheckboxWasClicked = 0;

        if (
            $companiesChecked
            && count(session($this->companiesSessionName))
            && ($clickedInPage == $inputPageOfPagination)
            && ($inputSelectAll == 1)
        ) {
            $atLeastOneCheckboxWasClicked = 1;
        }
        
        $statesChecked = [];
        if (! is_null(request()->states)) {
            request()->session()->put($this->statesSessionName, request()->states);
            $statesChecked = session($this->statesSessionName);
        }
        
        $activityFieldsChecked = [];
        if (! is_null(request()->activity_fields)) {
            request()->session()->put($this->activityFieldsSessionName, request()->activity_fields);
            $activityFieldsChecked = session($this->activityFieldsSessionName);
        }
        
        $searchParams = $request->query();

        /*Para pegar o ultimo satatus do Sig - 01/09/2023 - Renato Machado*/
        $company = null;
        foreach ($companies as $company) {
            $lastSigStatus = optional($company->sigCompanies()
                ->where('user_id', '=', $loggedUser->id)
                ->latest('created_at')
                ->first())->status;
            $company->last_sig_status = $lastSigStatus;
        }

        return view('layouts.company.search.step_two.index', compact(
            'companies',
            'companiesChecked',
            'statesChecked',
            'activityFieldsChecked',
            'btnExistsInSession',
            'clickedInPage',
            'inputPageOfPagination',
            'inputSelectAll',
            'atLeastOneCheckboxWasClicked',
            'statuses',
            'priorities',
            'reports',
            'searchParams',
        ));
    }

    public function showCompanySearchStepThree(Request $request)
    {
        // $this->authorize('ver-pesquisa-de-empresas');
        $statuses = Sig::STATUSES;
        $priorities = Sig::PRIORITIES;
        $companies = $this->getFilteredCompanies($request);
        // $workFeatures = $this->workFeature
        //     ->orderBy('description', 'asc')
        //     ->get();

        return view('layouts.company.search.step_three.index', compact(
            'companies',
            'statuses',
            'priorities',
        ));
    }

    public function checkAllCompanies(Request $request)
    {
        return $this->checkAllInputs(
            $request,
            $request->company_ids,
            $request->input_select_all_was_clicked,
            $request->clicked_in_page,
            $request->input_page_of_pagination,
            $this->companiesSessionName,
            'companies_selected'
        );
    }

    public function getFilteredCompanies(Request $request)
    {
        $loggedUser = Auth::user();
        $statesVisible = session('statesVisible');
        $startedAt = convertPtBrDateToEnDate($request->last_review_from);
        $endsAt = convertPtBrDateToEnDate($request->last_review_to);
        $activityFields = $request->activity_fields;
        $searchTrading = $request->search;
        $searchCompany = $request->searchCompany;
        $address = $request->address;
        $district = $request->district;
        $stateAcronym = $request->state_id;
        $cityId = $request->cities_ids;//Renato Machado 09/09/2023
        $cnpj = $request->cnpj;
        $primaryEmail = $request->primary_email;
        $homePage = $request->home_page;

        // State filter
        $allStateIds = null;
        $allStatesAcronym = null;
        $states = $this->state->select('state_acronym');

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

        $allStatesAcronym = $states->pluck('state_acronym');
        // Ends State filter
        
        //Diferencia empresas participantes de associados,
        // pois na tabela associates não existe compny_id da 
        // tabela companies - Renato machado - 11/09/2023
        $companies = $this->company
            ->leftJoin('associates', 'companies.id', '=', 'associates.company_id')
            ->whereNull('associates.company_id')
            ->select('companies.*');


        $allCompanyIds = null;
        if (
            (session()->has($this->companiesSessionName) || $request->companies_selected)
            && (! Route::is('company.search.step_two.index'))
        ) {
            $allCompanyIds = session()->has($this->companiesSessionName)
                ? session($this->companiesSessionName)
                : $request->companies_selected;

            $companies = $companies->whereIn('companies.id', $allCompanyIds);
        }

        if ($allStatesAcronym) {
            $companies = $companies->whereIn('companies.state', $allStatesAcronym);
        }

        if ($activityFields) {
            $companies = $companies->whereIn('companies.activity_field_id', $activityFields);
        }

        if ($searchTrading) {
            $companies = $companies->where('companies.trading_name', $searchTrading);
        }

        if ($searchCompany) {
            $companies = $companies->where('companies.company_name', $searchCompany);
        }

        if ($address) {
            $companies = $companies->where('companies.address', 'LIKE', '%'.$address.'%');
        }

        if ($district) {
            $companies = $companies->where('companies.district', 'LIKE', '%'.$district.'%');
        }

        if ($cnpj) {
            $companies = $companies->where('companies.cnpj', 'LIKE', '%'.$cnpj.'%');
        }

        if ($primaryEmail) {
            $companies = $companies->where('companies.primary_email', 'LIKE', '%'.$primaryEmail.'%');
        }

        if ($homePage) {
            $companies = $companies->where('companies.home_page', 'LIKE', '%'.$homePage.'%');
        }

        if ($stateAcronym) {
            $companies = $companies->where('companies.state', '=', $stateAcronym);
        }

//        if ($cityId) {
//            $city = $this->city->findOrFail($cityId);
//            $companies = $companies->where('companies.city', 'LIKE', '%'.$city->description.'%');
//        }
        
        /*filtro por até 4 cidades - Renato Machado - 09/06/2023*/
        if ($cityId && $stateAcronym) {
            $cityIds = explode(',', $cityId);
            $cityDescriptions = $this->city->whereIn('id', $cityIds)->pluck('description')->toArray();
            $companies = $companies->whereIn('companies.city', $cityDescriptions);
        }
        
        // Atividades da empresa
        $allActviypeIds = null;
        if (session()->has($this->activityFieldsSessionName) || $request->activity_fields) {
            $allActviypeIds = session()->has($this->activityFieldsSessionName)
                ? session($this->activityFieldsSessionName)
                : $request->activity_fields;
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
            $companies = $companies->whereBetween(
                'companies.last_review', [$dataFilterStartsAtFinal, $dataFilterEndsAtFinal]
            );
        }

        return $companies->paginate(self::REGISTRIES_PER_PAGE);
    }

    private function resetCompaniesSession(): void
    {
        request()->session()->forget([
            $this->companiesSessionName,
            $this->activityFieldsSessionName,
            $this->statesSessionName,
            'btnSelectAll'
        ]);
    }

    public function pushCompaniesSession(Request $request)
    {
        return $this->pushToSession(
            $request->company,
            $this->companiesSessionName,
            'companies_selected'
        );
    }

    public function removeCompaniesSession(Request $request)
    {
        return $this->removeFromSession(
            $request->company,
            $this->companiesSessionName,
            'companies_selected'
        );
    }
    
    public function export(Request $request)
    {
        $searchParams = $request->query();
        return Excel::download(
            new CompanySearchesExport(
                $searchParams,
                $this->company,
                $this->state,
                $this->city
            ),
            'pesquisa-de-empresas.xlsx'
        );
    }
}
