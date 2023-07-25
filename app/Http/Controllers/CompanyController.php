<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $company;
    protected $researcher;
    protected $activityField;

    public function __construct(
        Company $company,
        User $researcher,
        ActivityField $activityField
    ) {
        $this->company = $company;
        $this->researcher = $researcher;
        $this->activityField = $activityField;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = $this->company->allCompanies();
        return view('layouts.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = $this->company;
        $company->is_active = false;
        $researchers = $this->researcher
            ->whereHas('role', function (Builder $query) {
                $query->where('name', '=', 'Pesquisador');
            })->get();
        $activityFields = $this->activityField->get();

        return view('layouts.company.create', compact(
            'company',
            'researchers',
            'activityFields'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = $this->company;
        $company->researcher_id = $request->researcher_id;
        $company->activity_field_id = $request->activity_field_id;
        $company->company_name = $request->company_name;
        $company->trading_name = $request->trading_name;
        $company->trading_name_slug = $request->trading_name_slug;
        $company->minified_name = $request->minified_name;
        $company->address = $request->address;
        $company->number = $request->number;
        $company->complement = $request->complement;
        $company->district = $request->district;
        $company->city = $request->city;
        $company->city_registration = $request->city_registration;
        $company->state = $request->state;
        $company->state_registration = $request->state_registration;
        $company->state_acronym = $request->state_acronym;
        $company->zip_code = $request->zip_code;
        $company->phone_one = $request->phone_one;
        $company->notes = $request->notes;
        $company->cnpj = $request->cnpj;
        $company->primary_email = $request->primary_email;
        $company->secondary_email = $request->secondary_email;
        $company->home_page = $request->home_page;
        $company->skype = $request->skype;
        $company->sponsor = $request->sponsor;
        $company->sponsor_slug = $request->sponsor_slug;
        $company->company_segment_id = $request->company_segment_id;
        $company->is_active = $request->is_active;
        $company->is_project_owner = false;
        $company->image_storage_link = $request->image_storage_link;
        $company->image_public_link = $request->image_public_link;
        $company->last_review = convertPtBrDateToEnDate($request->last_review);
        $company->revision = $request->revision;
        $company->created_by = auth()->user()->id;
        $company->updated_by = auth()->user()->id;
        $company->register_ip = $request->register_ip;
        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $researchers = $this->researcher
            ->whereHas('role', function (Builder $query) {
                $query->where('name', '=', 'Pesquisador');
            })->get();
        $activityFields = $this->activityField->get();
        return view('layouts.company.edit', compact(
            'company',
            'researchers',
            'activityFields'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $company->researcher_id = $request->researcher_id;
        $company->activity_field_id = $request->activity_field_id;
        $company->company_name = $request->company_name;
        $company->trading_name = $request->trading_name;
        $company->trading_name_slug = $request->trading_name_slug;
        $company->minified_name = $request->minified_name;
        $company->address = $request->address;
        $company->number = $request->number;
        $company->complement = $request->complement;
        $company->district = $request->district;
        $company->city = $request->city;
        $company->city_registration = $request->city_registration;
        $company->state = $request->state;
        $company->state_registration = $request->state_registration;
        $company->state_acronym = $request->state_acronym;
        $company->zip_code = $request->zip_code;
        $company->phone_one = $request->phone_one;
        $company->notes = $request->notes;
        $company->cnpj = $request->cnpj;
        $company->primary_email = $request->primary_email;
        $company->secondary_email = $request->secondary_email;
        $company->home_page = $request->home_page;
        $company->skype = $request->skype;
        $company->sponsor = $request->sponsor;
        $company->sponsor_slug = $request->sponsor_slug;
        $company->company_segment_id = $request->company_segment_id;
        $company->is_active = $request->is_active;
        $company->is_project_owner = false;
        $company->image_storage_link = $request->image_storage_link;
        $company->image_public_link = $request->image_public_link;
        $company->last_review = convertPtBrDateToEnDate($request->last_review);
        $company->revision = $request->revision;
        $company->updated_by = auth()->user()->id;
        $company->register_ip = $request->register_ip;
        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index');
    }
}
