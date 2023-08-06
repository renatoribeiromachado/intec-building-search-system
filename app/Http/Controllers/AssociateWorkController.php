<?php

namespace App\Http\Controllers;

use App\Models\Phase;
use App\Models\Stage;
use Illuminate\Http\Request;

class AssociateWorkController extends Controller
{
    protected $stage;

    public function __construct(
        Stage $stage
    ) {
        $this->stage = $stage;
    }

    // public function __invoke()
    // {
    //     $stagesOne = $this->stage->where('phase_id', 1)->get();
    //     $stagesTwo = $this->stage->where('phase_id', 2)->get();
    //     $stagesThree = $this->stage->where('phase_id', 3)->get();

    //     return view('layouts.customer_area.search-work', compact(
    //         'stagesOne',
    //         'stagesTwo',
    //         'stagesThree',
    //     ));
    // }

    // public function create()
    // {
    //     return view('layouts.customer_area.associated_registration');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreCompanyRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $company = $this->company;
    //         $company->activity_field_id = $request->activity_field_id;
    //         $company->company_name = $request->company_name;
    //         $company->trading_name = $request->trading_name;
    //         $company->trading_name_slug = $request->trading_name_slug;
    //         $company->minified_name = $request->minified_name;
    //         $company->address = $request->address;
    //         $company->number = $request->number;
    //         $company->complement = $request->complement;
    //         $company->district = $request->district;
    //         $company->city = $request->city;
    //         $company->city_registration = $request->city_registration;
    //         $company->state = $request->state;
    //         $company->state_registration = $request->state_registration;
    //         $company->state_acronym = $request->state_acronym;
    //         $company->zip_code = $request->zip_code;
    //         $company->phone_one = $request->phone_one;
    //         $company->notes = $request->notes;
    //         $company->cnpj = $request->cnpj;
    //         $company->primary_email = $request->primary_email;
    //         $company->secondary_email = $request->secondary_email;
    //         $company->home_page = $request->home_page;
    //         $company->skype = $request->skype;
    //         $company->sponsor = $request->sponsor;
    //         $company->sponsor_slug = $request->sponsor_slug;
    //         $company->company_segment_id = $request->company_segment_id;
    //         $company->is_active = $request->is_active;
    //         $company->is_project_owner = false;
    //         $company->image_storage_link = $request->image_storage_link;
    //         $company->image_public_link = $request->image_public_link;
    //         $company->last_review = convertPtBrDateToEnDate($request->last_review);
    //         $company->revision = $request->revision;
    //         $company->created_by = auth()->user()->id;
    //         $company->updated_by = auth()->user()->id;
    //         $company->register_ip = $request->register_ip;
    //         $company->save();

    //         $researcher = $this->researcher->findOrFail($request->researcher_id);
    //         $company->researchers()->sync($researcher);

    //         DB::commit();

    //     } catch(\Exception $ex) {

    //         DB::rollBack();
            
    //         return redirect()->back()
    //             ->withInput($request->all())
    //             ->withErrors(['message' => $ex->getMessage()]);
    //     }

    //     return redirect()->route('company.edit', $company->id);
    // }
}
