<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanySearchController extends Controller
{
    const REGISTRIES_PER_PAGE = 50;

    protected $activityField;

    public function __construct(
        ActivityField $activityField
    ) {
        $this->activityField = $activityField;
    }

    public function showCompanySearchStepOne()
    {
        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get();

        // return $activityFields;

        return view('layouts.company.search.step_one.index', compact(
            'activityFields',
        ));
    }

    public function showWorkSearchStepTwo(Request $request)
    {
        // $activityFields = $this->activityField
        //     ->select('id', 'description')
        //     ->orderBy('description', 'asc')
        //     ->get();

        // return $activityFields;

        $companies = $this->getFilteredCompanies($request);

        return view('layouts.company.search.step_two.index', compact(
            'companies',
        ));
    }

    public function getFilteredCompanies(Request $request)
    {
        $loggedUser = Auth::user();
        $segments = $request->segments;

        $companies = DB::table('companies');

        if ($segments) {
            $companies = $companies->whereIn('activity_field_id', $segments);
        }

        return $companies->paginate(self::REGISTRIES_PER_PAGE);
    }
}
