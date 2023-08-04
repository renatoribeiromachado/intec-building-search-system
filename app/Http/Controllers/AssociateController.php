<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssociateRequest;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\ActivityField;
use App\Models\Associate;
use App\Models\Company;
use App\Models\Stage;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssociateController extends Controller
{
    protected $stage;
    protected $company;
    protected $associate;
    protected $state;
    protected $activityField;
    protected $salesperson;

    public function __construct(
        Stage $stage,
        Company $company,
        Associate $associate,
        State $state,
        ActivityField $activityField,
        User $salesperson
    ) {
        $this->stage = $stage;
        $this->company = $company;
        $this->associate = $associate;
        $this->state = $state;
        $this->activityField = $activityField;
        $this->salesperson = $salesperson;
    }

    public function __invoke()
    {
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();

        return view('layouts.associate.search-work', compact(
            'stagesOne',
            'stagesTwo',
            'stagesThree',
        ));
    }

    public function create()
    {
        $company = $this->company;
        $associate = $this->associate;
        $states = $this->state
            ->orderBy('state_acronym', 'asc')
            ->pluck('state_acronym', 'state_acronym');

        $segments = collect([
            ['description' => 'Comércio'],
            ['description' => 'Fabricação'],
            ['description' => 'Indústria'],
            ['description' => 'Serviços'],
        ])->pluck('description', 'description');

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get()->pluck('description', 'id');

        $cnpjs = collect([
                ['cnpj' => '30.252.400/0001-55'],
            ])->pluck('cnpj', 'cnpj');

        $isActive = collect([
                'Inativo',
                'Ativo',
            ]);

        $salespersons = $this->salesperson
            ->whereHas('role', function ($query) {
                return $query->userRole('Vendedor');
            })
            ->orderBy('name', 'asc')
            ->get()->pluck('name', 'id');

        return view('layouts.associate.create', compact(
            'company',
            'associate',
            'states',
            'segments',
            'activityFields',
            'cnpjs',
            'isActive',
            'salespersons',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssociateRequest $request) // StoreCompanyRequest
    {
        return $request->all();

        try {
            DB::beginTransaction();

            $company = $this->company;
            $company->activity_field_id = $request->activity_field_id;
            $company->company_name = $request->company_name;
            $company->trading_name = $request->trading_name;
            $company->trading_name_slug = Str::slug($request->trading_name_slug);
            $company->minified_name = $request->minified_name;
            $company->address = $request->address;
            $company->number = $request->number;
            $company->complement = $request->complement;
            $company->district = $request->district;
            $company->city = $request->city;
            // $company->city_registration = $request->city_registration;
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

            $researcher = $this->researcher->findOrFail($request->researcher_id);
            $company->researchers()->sync($researcher);

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        return redirect()->route('company.edit', $company->id);
    }
}
