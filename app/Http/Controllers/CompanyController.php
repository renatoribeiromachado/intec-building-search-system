<?php

namespace App\Http\Controllers;

use App\Models\ActivityField;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Contact;
use App\Models\Position;

class CompanyController extends Controller
{
    protected $company;
    protected $researcher;
    protected $activityField;
    protected $position;

    public function __construct(
        Company $company,
        User $researcher,
        ActivityField $activityField,
        Position $position
    ) {
        $this->company = $company;
        $this->researcher = $researcher;
        $this->activityField = $activityField;
        $this->position = $position;
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
    public function store(StoreCompanyRequest $request)
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
        $positions = $this->position->get();
        return view('layouts.company.edit', compact(
            'company',
            'researchers',
            'activityFields',
            'positions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeContact(Request $request, Company $company)
    {
        $contact = new Contact();
        $contact->company_id = $company->id;
        $contact->position_id = $request->position_id;
        $contact->name = $request->name;
        $contact->ddd = $request->ddd;
        $contact->main_phone = $request->main_phone;
        $contact->ddd_fax = $request->ddd_fax;
        $contact->fax = $request->fax;
        $contact->email = $request->email;
        $contact->ddd_two = $request->ddd_two;
        $contact->phone_two = $request->phone_two;
        $contact->ddd_three = $request->ddd_three;
        $contact->phone_three = $request->phone_three;
        $contact->ddd_four = $request->ddd_four;
        $contact->phone_four = $request->phone_four;
        $contact->phone_type_one = $request->phone_type_one;
        $contact->phone_type_two = $request->phone_type_two;
        $contact->phone_type_three = $request->phone_type_three;
        $contact->is_active = true;
        $contact->created_by = auth()->guard('web')->user()->id;
        $contact->updated_by = auth()->guard('web')->user()->id;
        $contact->save();

        return redirect()->back();
    }

    /**
     * Update an existent resource from the storage.
     *
     * @param  \App\Http\Requests\StoreWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updateContact(Request $request, Contact $contact)
    {
        $contact->position_id = $request->position_id;
        $contact->name = $request->name;
        $contact->ddd = $request->ddd;
        $contact->main_phone = $request->main_phone;
        $contact->ddd_fax = $request->ddd_fax;
        $contact->fax = $request->fax;
        $contact->email = $request->email;
        $contact->ddd_two = $request->ddd_two;
        $contact->phone_two = $request->phone_two;
        $contact->ddd_three = $request->ddd_three;
        $contact->phone_three = $request->phone_three;
        $contact->ddd_four = $request->ddd_four;
        $contact->phone_four = $request->phone_four;
        $contact->phone_type_one = $request->phone_type_one;
        $contact->phone_type_two = $request->phone_type_two;
        $contact->phone_type_three = $request->phone_type_three;
        $contact->is_active = true;
        $contact->updated_by = auth()->guard('web')->user()->id;
        $contact->save();

        return redirect()->back();
    }

    public function destroyContact(Request $request, Contact $contact)
    {
        $contact->delete();
        return redirect()->back();
    }
}
