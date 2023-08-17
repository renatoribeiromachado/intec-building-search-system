<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CompanySearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $activityField;
    protected $company;

    public function __construct(
        ActivityField $activityField,
        Company $company
    ) {
        $this->activityField = $activityField;
        $this->company = $company;
    }

    public function showCompanySearchStepOne()
    {
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

        return view('layouts.company.search.step_two.index', compact(
            'companies',
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
}
