<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssociateRequest;
use App\Http\Requests\UpdateAssociateRequest;
use App\Models\ActivityField;
use App\Models\Associate;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Position;
use App\Models\Role;
use App\Models\SegmentSubType;
use App\Models\Stage;
use App\Models\State;
use App\Models\User;
use App\Traits\ContactActionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssociateController extends Controller
{
    use ContactActionsTrait;
    
    const BUSINESS_BRANCH = [
        ['description' => 'Comércio'],
        ['description' => 'Fabricação'],
        ['description' => 'Indústria'],
        ['description' => 'Serviços'],
    ];
    const LINKED_COMPANY_CNPJS = [
        ['cnpj' => '30.252.400/0001-55'],
    ];

    protected $stage;
    protected $company;
    protected $associate;
    protected $state;
    protected $activityField;
    protected $salesperson;
    protected $contact;
    protected $position;
    protected $plan;
    protected $user;
    protected $role;
    protected $segmentSubType;

    public function __construct(
        Stage $stage,
        Company $company,
        Associate $associate,
        State $state,
        ActivityField $activityField,
        User $salesperson,
        Contact $contact,
        Position $position,
        Plan $plan,
        User $user,
        Role $role,
        SegmentSubType $segmentSubType
    ) {
        $this->stage = $stage;
        $this->company = $company;
        $this->associate = $associate;
        $this->state = $state;
        $this->activityField = $activityField;
        $this->salesperson = $salesperson;
        $this->contact = $contact;
        $this->position = $position;
        $this->plan = $plan;
        $this->user = $user;
        $this->role = $role;
        $this->segmentSubType = $segmentSubType;
    }

    public function __invoke(Request $request)
    {
        $associates = $request->has('search_id')
            ? $this->associate->allAssociates($request)
            : [];

        return view('layouts.associate.index', compact(
            'associates',
        ));
    }

    public function create()
    {
        $company = $this->company;
        $associate = $this->associate;
        $states = $this->state
            ->orderBy('state_acronym', 'asc')
            ->pluck('state_acronym', 'state_acronym');

        $businessBranches = collect(self::BUSINESS_BRANCH)
            ->pluck('description', 'description');

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get()->pluck('description', 'id');

        $cnpjs = collect(self::LINKED_COMPANY_CNPJS)
            ->pluck('cnpj', 'cnpj');

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
            $associate->data_filter_starts_at = convertPtBrDateToEnDate($request->data_filter_starts_at);
            $associate->data_filter_ends_at = convertPtBrDateToEnDate($request->data_filter_ends_at);
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

        return redirect()->route('associate.edit', $associate->id);
    }

    public function edit(Request $request, Associate $associate)
    {
        $company = $associate->company;
        $contacts = $company->contacts()
            ->whereDoesntHave('user')
            ->get();

        $associates = $company->contacts()
            ->whereHas('user')
            ->orderBy('contacts.name', 'asc')
            ->get();

        $states = $this->state
            ->orderBy('state_acronym', 'asc')
            ->pluck('state_acronym', 'state_acronym');

        $businessBranches = collect(self::BUSINESS_BRANCH)
            ->pluck('description', 'description');

        $activityFields = $this->activityField
            ->select('id', 'description')
            ->orderBy('description', 'asc')
            ->get()->pluck('description', 'id');

        $cnpjs = collect(self::LINKED_COMPANY_CNPJS)
            ->pluck('cnpj', 'cnpj');

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

        $contact = $this->contact;
        $positions = $this->position->getPositionList();
        $orders = $company->orders()->get();
        
        $situations = collect(Order::ORDER_SITUATIONS)
            ->pluck('description', 'description');

        $plans = $this->plan->pluck('description', 'id');

        $installments = collect(Order::ORDER_INSTALLMENTS)
            ->pluck('description', 'installment');

        $user = $this->user;
        $roles = $this->role
            ->select('id', 'name')
            ->whereIn('slug', ['associado-gestora', 'associado-usuario'])
            ->orderBy('name', 'asc')
            ->get()->pluck('name', 'id');

        // Subscription
        $stagesOne = $this->stage->where('phase_id', 1)->get();
        $stagesTwo = $this->stage->where('phase_id', 2)->get();
        $stagesThree = $this->stage->where('phase_id', 3)->get();

        $statesOne = $this->state->where('zone_id', 1)->get();
        $statesTwo = $this->state->where('zone_id', 2)->get();
        $statesThree = $this->state->where('zone_id', 3)->get();
        $statesFour = $this->state->where('zone_id', 4)->get();
        $statesFive = $this->state->where('zone_id', 5)->get();

        $segmentSubTypeOne = $this->segmentSubType->where('segment_id', 1)->get();
        $segmentSubTypeTwo = $this->segmentSubType->where('segment_id', 2)->get();
        $segmentSubTypeThree = $this->segmentSubType->where('segment_id', 3)->get();

        return view('layouts.associate.edit', compact(
            'associate',
            'states',
            'company',
            'businessBranches',
            'activityFields',
            'cnpjs',
            'isActive',
            'salespersons',
            'contact',
            'contacts',
            'positions',
            'orders',
            'situations',
            'plans',
            'installments',
            'user',
            'roles',
            'associates',

            // subscription
            'stagesOne',
            'stagesTwo',
            'stagesThree',
            'statesOne',

            'statesOne',
            'statesTwo',
            'statesThree',
            'statesFour',
            'statesFive',

            'segmentSubTypeOne',
            'segmentSubTypeTwo',
            'segmentSubTypeThree',
        ));
    }

    public function update(UpdateAssociateRequest $request, Associate $associate)
    {
        try {
            
            DB::beginTransaction();

            // Company
            $company = $associate->company;
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
            $company->updated_by = auth()->user()->id;
            $company->save();

            // Associate
            $associate->company_id = $company->id;
            $associate->salesperson_id = $request->salesperson_id;
            $associate->linked_company = $request->linked_company;
            $associate->business_branch = $request->business_branch;
            $associate->company_date_birth = $request->company_date_birth;
            $associate->data_filter_starts_at = convertPtBrDateToEnDate($request->data_filter_starts_at);
            $associate->data_filter_ends_at = convertPtBrDateToEnDate($request->data_filter_ends_at);
            $associate->contract_due_date_start = convertPtBrDateToEnDate($request->contract_due_date_start);
            $associate->products_and_services = $request->products_and_services;
            $associate->updated_by = auth()->user()->id;
            $associate->save();

            DB::commit();

        } catch(\Exception $ex) {

            DB::rollBack();
            
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['message' => $ex->getMessage()]);
        }

        session()->flash('success', 'Associado atualizado.');

        return redirect()->route('associate.edit', $associate->id);
    }
}
