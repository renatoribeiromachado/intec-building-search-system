<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $company;

    public function __construct(
        Company $company
    ) {
        $this->company = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->company->all();

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
        return view('layouts.company.create', compact('company'));
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
        $company->notes = $request->notes;
        $company->cnpj = $request->cnpj;
        $company->primary_email = $request->primary_email;
        $company->secondary_email = $request->secondary_email;
        $company->home_page = $request->home_page;
        $company->skype = $request->skype;
        $company->sponsor = $request->sponsor;
        $company->sponsor_slug = $request->sponsor_slug;
        $company->company_segment_id = $request->company_segment_id;
        $company->is_active = false;
        $company->is_project_owner = false;
        $company->image_storage_link = $request->image_storage_link;
        $company->image_public_link = $request->image_public_link;
        $company->created_by = auth()->user()->id;
        $company->updated_by = auth()->user()->id;
        $company->register_ip = $request->register_ip;
        $company->save();

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('layouts.company.edit', compact('company'));
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
        $company->notes = $request->notes;
        $company->cnpj = $request->cnpj;
        $company->primary_email = $request->primary_email;
        $company->secondary_email = $request->secondary_email;
        $company->home_page = $request->home_page;
        $company->skype = $request->skype;
        $company->sponsor = $request->sponsor;
        $company->sponsor_slug = $request->sponsor_slug;
        $company->company_segment_id = $request->company_segment_id;
        $company->is_active = false;
        $company->is_project_owner = false;
        $company->image_storage_link = $request->image_storage_link;
        $company->image_public_link = $request->image_public_link;
        $company->created_by = auth()->user()->id;
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
    public function destroy($id)
    {
        //
    }
}
