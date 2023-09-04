<?php

namespace App\Exports;

use App\Models\City;
use App\Models\State;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CompanySearchesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    const DATE_FORMAT = 'd/m/Y';

    protected $searchParams;
    protected $company;
    protected $state;
    protected $city;
    protected $CompaniesSessionName = 'companies_checkboxes';
    protected $segmentSubTypesSessionName = 'segment_sub_types_checkboxes';
    protected $statesSessionName = 'states_checkboxes';

    public function __construct(
        $searchParams,
        Company $company,
        State $state,
        City $city
    ) {
        $this->searchParams = $searchParams;
        $this->company = $company;
        $this->state = $state;
        $this->city = $city;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function returnContacts($data) {

        $sql = "SELECT
                    ct.name,
                    ct.email,
                    ct.secondary_email,
                    ct.tertiary_email,
                    ct.ddd,
                    ct.main_phone,
                    ct.ddd_two,
                    ct.phone_two,
                    ct.ddd_three,
                    ct.phone_three,
                    ct.ddd_four,
                    ct.phone_four,
                    p.description AS position
                    FROM companies c
                    JOIN contacts ct ON ct.company_id = c.id
                    JOIN positions p ON p.id = ct.position_id
                    WHERE c.id = $data";
        $results = \DB::select($sql);

        return $results;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $loggedUser = Auth::user();
        $statesVisible = session('statesVisible');
        $startedAt = $this->searchParams['last_review_from_1'];
        $endsAt = $this->searchParams['last_review_to_1'];
        $address = $this->searchParams['address_1'];
        $district = $this->searchParams['district_1'];
        $stateAcronym = isset($this->searchParams['state_id'])
            ? $this->searchParams['state_id']
            : null;
        $cityId = isset($this->searchParams['city_id'])
            ? $this->searchParams['city_id']
            : null;
        
        // Razão social
        $searchCompanyName = isset($searchParams['company_name'])
            ? $searchCompanyName['company_name']
            : null;

        // Fantasia
        $searchTrading = isset($searchParams['trading_name'])
            ? $searchTrading['trading_name']
            : null;

        // Region filters
        $allStateIds = null;
        $allStatesAcronym = null;
        $states = $this->state->select('state_acronym');

        if (session()->has($this->statesSessionName) || isset($this->searchParams['states'])) {
            $allStateIds = session()->has($this->statesSessionName)
                ? session($this->statesSessionName)
                : $this->searchParams['states'];
        }

        if ((! session()->has('statesVisible')) && isset($allStateIds)) {
            $states = $states->whereIn('id', $allStateIds);
        }

        if (session()->has('statesVisible') && (! isset($allStateIds))) {
            $states = $states->whereIn('id', $statesVisible);
        }

        if (session()->has('statesVisible') && isset($allStateIds)) {
            $statesToSearch = [];
            foreach (session('statesVisible') as $stateVisible) {
                if (in_array($stateVisible, $allStateIds)) {
                    array_push($statesToSearch, $stateVisible);
                }
            }
            $states = $states->whereIn('id', $statesToSearch);
        }

        $allStatesAcronym = $states->get()->pluck('state_acronym');

        $companies = $this->company
            ->select(
                'companies.*',
                'activity_fields.description AS description',
            )
            ->join('activity_fields', 'companies.activity_field_id', '=', 'activity_fields.id');
        
        
        $allComapanyIds = null;
        if (
            (session()->has($this->CompaniesSessionName) || isset($this->searchParams['works_selected']))
            && (! Route::is('company.search.step_two.index'))
        ) {
            $allComapanyIds = session()->has($this->CompaniesSessionName)
                ? session($this->CompaniesSessionName)
                : $this->searchParams['companies_selected'];
            $companies = $companies->whereIn('companies.id', $allComapanyIds);
        }
        
        /*Todos os estados*/
        if ($allStatesAcronym) {
            $companies = $companies->whereIn('companies.state', $allStatesAcronym);
        }

        /*Endereço*/
        if ($address) {
            $companies = $companies->where('companies.address', 'LIKE', '%'.$address.'%');
        }
        
        /*Bairro*/
        if ($district) {
            $companies = $companies->where('companies.district', 'LIKE', '%'.$district.'%');
        }

        /*Estado*/
        if ($stateAcronym) {
            $companies = $companies->where('companies.state', '=', $stateAcronym);
        }
        
        /*Cidade*/
        if ($cityId) {
            $city = $this->city->findOrFail($cityId);
            $companies = $companies->where('companies.city', 'LIKE', '%'.$city->description.'%');
        }

        /**
         * The associate user only can search works based in the associate period fields:
         *
         *  - data_filter_starts_at and;
         *  - data_filter_ends_at.
         */
        $dataFilterStartsAtFinal = $startedAt;
        $dataFilterEndsAtFinal = $endsAt;
        if (authUserIsAnAssociate()) {
            $dataFilterStartsAt1 = $loggedUser->contact->company->associate->data_filter_starts_at->format('Y-m-d');
            $dataFilterEndsAt1 = $loggedUser->contact->company->associate->data_filter_ends_at->format('Y-m-d');

            $dataFilterStartsAtFinal = $dataFilterStartsAt1;
            $dataFilterEndsAtFinal = $dataFilterEndsAt1;

            if ($startedAt && $endsAt) {

                $dataFilterStartsAtFinal = ($startedAt >= $dataFilterStartsAt1)
                    ? $startedAt
                    : $dataFilterStartsAt1;

                $dataFilterEndsAtFinal = ($endsAt <= $dataFilterEndsAt1)
                    ? $endsAt
                    : $dataFilterEndsAt1;
            }
        }

        if ($dataFilterStartsAtFinal || $dataFilterEndsAtFinal) {
            $companies = $companies->whereBetween(
                'companies.last_review', [$dataFilterStartsAtFinal, $dataFilterEndsAtFinal]
            );
        }

        return $companies
            ->limit(500)
            ->get()
            ->map(function ($company) {
                $contacts = $this->returnContacts($company->id);
                
                $contactColumns = [];
                $index = 0;
                foreach ($contacts as $contact) {
                    $index++;
                    $contactColumns["contact_{$index}_name"] = $contact->name;
                    $contactColumns["contact_{$index}_position"] = $contact->position;
                    $contactColumns["contact_{$index}_email"] = $contact->email;
                    $contactColumns["contact_{$index}_ddd"] = $contact->ddd;
                    $contactColumns["contact_{$index}_main_phone"] = $contact->main_phone;
                }

                $contactData = [];
                for ($i = 1; $i <= 3; $i++) {
                    $contactData["contact_name_{$i}"] = $contactColumns["contact_{$i}_name"] ?? null;
                    $contactData["contact_position_{$i}"] = $contactColumns["contact_{$i}_position"] ?? null;
                    $contactData["contact_email_{$i}"] = $contactColumns["contact_{$i}_email"] ?? null;
                    $contactData["contact_ddd_{$i}"] = $contactColumns["contact_{$i}_ddd"] ?? null;
                    $contactData["contact_main_phone_{$i}"] = $contactColumns["contact_{$i}_main_phone"] ?? null;
                }

                $companyData = [];
                for ($i = 1; $i <= 3; $i++) {
                    $companyData["company_company_name_{$i}"] = $companyColumns["company_{$i}_company_name"]
                        ?? null;
                    $companyData["company_activity_field_{$i}"] = $companyColumns["company_{$i}_activity_field"]
                        ?? null; // Modalidade
                    $companyData["company_cnpj_{$i}"] = $companyColumns["company_{$i}_cnpj"]
                        ?? null;
                }

                return [
                    $company->id, 
                    $company->description, 
                    optional($company->last_review)->format(self::DATE_FORMAT),
                    $company->revision,
                    $company->company_name, 
                    $company->trading_name,
                    $company->zip_code,
                    $company->address,
                    $company->number, 
                    $company->complement,
                    $company->district,
                    $company->city,
                    $company->state,
                    $company->cnpj,
                    $company->phone_one,
                    $company->primary_email,
                    $company->secondary_email,
                    $company->home_page,
                    $company->notes,
                    
                    /*Contatos*/
                    $contactData["contact_name_1"],
                    $contactData["contact_position_1"],
                    $contactData["contact_email_1"],
                    $contactData["contact_ddd_1"],
                    $contactData["contact_main_phone_1"],

                    $contactData["contact_name_2"],
                    $contactData["contact_position_2"],
                    $contactData["contact_email_2"],
                    $contactData["contact_ddd_2"],
                    $contactData["contact_main_phone_2"],

                    $contactData["contact_name_3"],
                    $contactData["contact_position_3"],
                    $contactData["contact_email_3"],
                    $contactData["contact_ddd_3"],
                    $contactData["contact_main_phone_3"],
                    
                ];
            });
    }

    public function headings(): array {
        return [
            /* Dados da empresa */
            'Código',
            'Segmento',
            'Data da última atualização',
            'Nº de revisão',
            'Razão social',
            'Fantasia',
            'CEP',
            'Endereço',
            'Nº',
            'Complemento',
            'Bairro',
            'Cidade',
            'Estado',
            'CNPJ',
            'Telefone',
            'E-mail 1',
            'E-mail 2',
            'site',
            'Detalhes',

            /* Contatos */
            'Nome do Contato 1',
            'Cargo 1',
            'Email do Contato 1',
            'DDD 1',
            'Telefone do Contato 1',

            'Nome do Contato 2',
            'Cargo 2',
            'Email do Contato 2',
            'DDD 2',
            'Telefone do Contato 2',

            'Nome do Contato 3',
            'Cargo 3',
            'Email do Contato 3',
            'DDD 3',
            'Telefone do Contato 3',

        ];
    }
}