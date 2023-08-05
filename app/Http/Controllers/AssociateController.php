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

        $businessBranches = collect([
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
            'businessBranches',
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

        try {
            DB::beginTransaction();

            // Company
            $company = $this->company;
            $company->activity_field_id = $request->activity_field_id;
            $company->company_name = $request->company_name;
            $company->trading_name = $request->trading_name;
            $company->trading_name_slug = Str::slug($request->trading_name_slug);
            $company->address = $request->address;
            $company->number = $request->number;
            $company->complement = $request->complement;
            $company->district = $request->district;
            $company->city = $request->city;
            $company->state = $request->state;
            $company->state_registration = $request->state_registration;
            $company->state_acronym = $request->state_acronym;
            $company->zip_code = $request->zip_code;
            $company->phone_one = $request->phone_one;
            $company->notes = $request->notes;
            $company->cnpj = $request->cnpj;
            $company->primary_email = $request->primary_email;
            $company->home_page = $request->home_page;
            $company->is_active = $request->is_active;
            $company->is_project_owner = false;
            $company->last_review = convertPtBrDateToEnDate($request->last_review);
            $company->created_by = auth()->user()->id;
            $company->updated_by = auth()->user()->id;
            $company->save();

            // Associate
            $associate = $this->associate;
            $associate->company_id = $company->id;
            $associate->salesperson_id = $request->salesperson_id;
            $associate->linked_company = $request->linked_company;
            $associate->business_branch = $request->business_branch;
            $associate->company_date_birth = $request->company_date_birth;
            $associate->contract_due_date_start = convertPtBrDateToEnDate($request->contract_due_date_start);
            $associate->products_and_services = $request->products_and_services;
            $associate->created_by = auth()->user()->id;
            $associate->updated_by = auth()->user()->id;
            $associate->save();

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        session()->flash('success', 'Associado criado.');

        return redirect()->route('associate.create');
    }
}
