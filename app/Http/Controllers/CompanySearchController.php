<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use App\Models\Associate;
use App\Models\City;
use App\Models\Company;
use App\Models\SegmentSubType;
use App\Models\State;
use App\Traits\SelectCheckboxes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

    public function __construct(
        ActivityField $activityField,
        Company $company,
        State $state,
        City $city,
        SegmentSubType $segmentSubType
    ) {
        $this->activityField = $activityField;
        $this->company = $company;
        $this->state = $state;
        $this->city = $city;
        $this->segmentSubType = $segmentSubType;
    }

    public function showCompanySearchStepOne()
    {
        $this->resetCompaniesSession();

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get();

        $authUser = Auth::user();

        if ($authUser->role->slug == Associate::ASSOCIATE_MANAGER ||
            $authUser->role->slug == Associate::ASSOCIATE_USER) {

            $statesVisible = $authUser->contact->company->associate->states()->get()->pluck('id');
            $segmentSubTypesVisible = $authUser->contact->company->associate->segmentSubTypes()->get()->pluck('id');
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

    public function showWorkSearchStepTwo(Request $request)
    {
        $companies = $this->getFilteredCompanies($request);
        $companiesChecked = session($this->companiesSessionName);
        $currentPage = is_null($request->page) ? 1 : $request->page;
        $btnExistsInSession = session()->has('btnSelectAll');

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
        ));
    }

    public function showWorkSearchStepThree(Request $request)
    {
        // $this->authorize('ver-pesquisa-de-empresas');
        
        $companies = $this->getFilteredCompanies($request);
        // $workFeatures = $this->workFeature
        //     ->orderBy('description', 'asc')
        //     ->get();

        return view('layouts.company.search.step_three.index', compact(
            'companies',
            // 'workFeatures'
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
        $activityFields = $request->activity_fields;
        $tradingName = $request->trading_name;
        $companyName = $request->company_name;
        $address = $request->address;
        $district = $request->district;
        $stateAcronym = $request->state_id;
        $cityId = $request->city_id;
        $cnpj = $request->cnpj;
        $primaryEmail = $request->primary_email;
        $homePage = $request->home_page;

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

        $companies = $this->company;

        $allCompanyIds = null;
        if (
            (session()->has($this->companiesSessionName) || $request->companies_selected)
            && (! Route::is('company.search.step_two.index'))
        ) {
            $allCompanyIds = session()->has($this->companiesSessionName)
                ? session($this->companiesSessionName)
                : $request->companies_selected;
            // $allCompanyIds = $request->companies_selected;
            $companies = $companies->whereIn('companies.id', $allCompanyIds);
        }

        if ($allStatesAcronym) {
            $companies = $companies->whereIn('companies.state', $allStatesAcronym);
        }

        if ($activityFields) {
            $companies = $companies->whereIn('companies.activity_field_id', $activityFields);
        }

        if ($tradingName) {
            $companies = $companies->where('companies.trading_name', 'LIKE', '%'.$tradingName.'%');
        }

        if ($companyName) {
            $companies = $companies->where('companies.company_name', 'LIKE', '%'.$companyName.'%');
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

        if ($cityId) {
            $city = $this->city->findOrFail($cityId);
            $companies = $companies->where('companies.city', 'LIKE', '%'.$city->description.'%');
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
}
