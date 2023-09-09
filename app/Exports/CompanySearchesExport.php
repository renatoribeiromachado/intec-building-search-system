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
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
    protected $stateSessionName = 'state_selected';
    

    public function __construct(
        $searchParams,
        Company $company,
        State $state,
        City $city,
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

            1 => [
                'font' => [
                    'bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12, 
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1f497d'],
                ],

                'padding' => [
                    'top' => 80, // Padding superior de 40 pixels
                    'bottom' => 80, // Padding inferior de 40 pixels
                    'left' => 80, // Padding esquerdo de 40 pixels
                    'right' => 80, // Padding direito de 40 pixels
                ],
            ],
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
        
        $stateAcronym = isset($this->searchParams['state_id_1'])
        ? $this->searchParams['state_id_1']
        : null;
       
        /*Cidades - Renato Machado 05/09/2023*/
        $cityIds = isset($this->searchParams['cities_ids_1']) 
                ? explode(',', $this->searchParams['cities_ids_1']) 
                : [];
        
        // Razão social
        $searchCompanyName = isset($this->searchParams['searchCompany_1'])
            ? $this->searchParams['searchCompany_1']
            : null;
        
        // Fantasia
        $searchTradingName = isset($this->searchParams['search_1'])
            ? $this->searchParams['search_1']
            : null;
        
        // Email principal
        $searchEmail = isset($this->searchParams['primary_email_1'])
            ? $this->searchParams['primary_email_1']
            : null;
        
        // CNPJ
        $searchCnpj = isset($this->searchParams['cnpj_1'])
            ? $this->searchParams['cnpj_1']
            : null;
        
        // Site
        $searchSite = isset($this->searchParams['home_page_1'])
            ? $this->searchParams['home_page_1']
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
            $companies = $companies->where('companies.state', $stateAcronym);
        }
        
        /*City*/
        if (!empty($cityIds)) {
            // Busque as cidades com base nos IDs
            $cities = $this->city->findOrFail($cityIds);

            // Extraia as descrições das cidades para filtragem
            $cityDescriptions = $cities->pluck('description')->toArray();

            // Use as descrições das cidades para filtrar os trabalhos
            $companies = $companies->whereIn('companies.city', $cityDescriptions);
        }
        
        /*Razão social*/
        if ($searchCompanyName) {   
            $companies = $companies->where('companies.company_name', $searchCompanyName);
        }
        
        /*Fantasia*/
        if ($searchTradingName) {   
            $companies = $companies->where('companies.trading_name', $searchTradingName);
        }
        
        /*CNPJ*/
        if ($searchCnpj) {   
            $companies = $companies->where('companies.cnpj', $searchCnpj);
        }
       
        /*Email principal*/
        if ($searchEmail) {   
            $companies = $companies->where('companies.primary_email', $searchEmail);
        }

        /*Site*/
        if ($searchSite) {   
            $companies = $companies->where('companies.home_page', $searchSite);
        }

        /**
         * The associate user only can search company based in the associate period fields:
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

        return $companies->limit(500)->get()->map(function ($company) {
        $contacts = $this->returnContacts($company->id);

        $contactData = [];

        for ($i = 1; $i <= 30; $i++) {
            $contactData["contact_name_{$i}"] = null;
            $contactData["contact_position_{$i}"] = null;
            $contactData["contact_email_{$i}"] = null;
            $contactData["contact_main_phone_{$i}"] = null;
        }
        
        foreach ($contacts as $index => $contact) {
            $contactData["contact_name_" . ($index + 1)] = $contact->name;
            $contactData["contact_position_" . ($index + 1)] = $contact->position;
            $contactData["contact_email_" . ($index + 1)] = (!empty($contact->email) ? "{$contact->email}" : '' ) .(!empty($contact->secondary_email) ? " / {$contact->secondary_email}" : '' ) .(!empty($contact->tertiary_email) ? " / {$contact->tertiary_email}" : '' );
            $contactData["contact_main_phone_" . ($index + 1)] = (!empty($contact->ddd) && !empty($contact->main_phone) ? "({$contact->ddd}) {$contact->main_phone}" : '' )
                                                                    .(!empty($contact->ddd_two) && !empty($contact->phone_two) ? " / ($contact->ddd_two) $contact->phone_two" : '' )
                                                                    . (!empty($contact->ddd_three) && !empty($contact->phone_three) ? " / ($contact->ddd_three) $contact->phone_three" : '' )
                                                                    . (!empty($contact->ddd_four) && !empty($contact->phone_four) ? " / ($contact->ddd_four) $contact->phone_four" : '' );
        }

        return array_merge([
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
               (!empty($company->phone_one) ? $company->phone_one : ''),
                $company->primary_email,
                $company->secondary_email,
                $company->home_page,
                $company->notes,
            ], $contactData);
        });
    }

    public function headings(): array {
       
        $header = [
            /* Dados da empresa */
            'Código',
            'Atividade',
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
            'Site',
            'Detalhes',      
        ];
        
        /* Contatos */
        $contactsCount = 30;
        for ($i = 1; $i <= $contactsCount; $i++) {
            $header[] = "Nome do Contato $i";
            $header[] = "Cargo $i";
            $header[] = "Email do Contato $i";
            //$header[] = "DDD $i";
            $header[] = "Telefone do Contato $i";
        }

        return $header;
    }
}