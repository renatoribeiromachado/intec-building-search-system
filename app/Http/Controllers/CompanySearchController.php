<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use App\Models\Company;
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

    public function __construct(
        ActivityField $activityField,
        Company $company
    ) {
        $this->activityField = $activityField;
        $this->company = $company;
    }

    public function showCompanySearchStepOne()
    {
        $this->resetCompaniesSession();

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get();

        return view('layouts.company.search.step_one.index', compact(
            'activityFields',
        ));
    }

    public function showWorkSearchStepTwo(Request $request)
    {
        $companies = $this->getFilteredCompanies($request);
        $companiesChecked = session($this->companiesSessionName);
        $currentPage = is_null($request->page) ? 1 : $request->page;
        $btnExistsInSession = session()->has('btnSelectAll');

        $clickedInPage = $btnExistsInSession && session('btnSelectAll')['btn_clicked'] == 1
            ? session('btnSelectAll')['clicked_in_page']
            : $currentPage;

        $inputPageOfPagination = $currentPage;

        $inputSelectAll = $btnExistsInSession
            ? session('btnSelectAll')['btn_clicked']
            : 0;

        $atLeastOneCheckboxWasClicked = 0;

        if ($companiesChecked) {

            // $atLeastOneCheckboxWasClicked = count(session($this->companiesSessionName));
            
            if ( count( session($this->companiesSessionName) ) &&
                ($clickedInPage == $inputPageOfPagination) &&
                ($inputSelectAll == 1) ) {
                $atLeastOneCheckboxWasClicked = 1;
            }
        }

        return view('layouts.company.search.step_two.index', compact(
            'companies',
            'companiesChecked',
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

        $companies = $this->company;

        $allCompanyIds = null;
        if (/*(session()->has($this->companiesSessionName) || $request->companies_selected) &&*/
            ! Route::is('company.search.step_two.index')) {
            // $allCompanyIds = session()->has($this->companiesSessionName)
            //     ? session($this->companiesSessionName)
            //     : $request->companies_selected;
            $allCompanyIds = $request->companies_selected;
            $companies = $companies->whereIn('companies.id', $allCompanyIds);
        }

        if ($activityFields) {
            $companies = $companies->whereIn('companies.activity_field_id', $activityFields);
        }

        return $companies->paginate(self::REGISTRIES_PER_PAGE);
    }

    private function resetCompaniesSession(): void
    {
        request()->session()->forget([
            $this->companiesSessionName,
            // $this->stagesSessionName,
            // $this->segmentSubTypesSessionName,
            // $this->statesSessionName,
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
