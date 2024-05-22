<?php

namespace App\Exports;

use App\Models\City;
use App\Models\State;
use App\Models\Work;
use App\Models\WorkFeature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class WorkSearchesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    const DATE_FORMAT = 'd/m/Y';

    protected $searchParams;
    protected $work;
    protected $state;
    protected $city;
    protected $worksSessionName = 'works_checkboxes';
    protected $stagesSessionName = 'stages_checkboxes';
    protected $segmentSubTypesSessionName = 'segment_sub_types_checkboxes';
    protected $statesSessionName = 'states_checkboxes';

    public function __construct(
        $searchParams,
        Work $work,
        State $state,
        City $city
    ) {
        $this->searchParams = $searchParams;
        $this->work = $work;
        $this->state = $state;
        $this->city = $city;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function returnContacts($data) 
    {

        $sql = "SELECT 
                    w.id, 
                    w.name as work, 
                    c.name, 
                    c.email,
                    c.secondary_email,
                    c.tertiary_email,
                    c.ddd,
                    c.main_phone,
                    c.ddd_two,
                    c.phone_two,
                    c.ddd_three,
                    c.phone_three,
                    c.ddd_four,
                    c.phone_four,
                    p.description as position,
                    cp.trading_name AS fantasy,
                    cp.cnpj
                FROM 
                    works w 
                JOIN 
                    (
                        SELECT 
                            cw.work_id,
                            c.id,
                            c.name, 
                            c.email,
                            c.secondary_email,
                            c.tertiary_email,
                            c.ddd,
                            c.main_phone,
                            c.ddd_two,
                            c.phone_two,
                            c.ddd_three,
                            c.phone_three,
                            c.ddd_four,
                            c.phone_four,
                            c.position_id,
                            c.company_id, 
                            cp.trading_name,
                            cp.cnpj
                        FROM 
                            contact_work cw 
                        LEFT JOIN 
                            contacts c ON c.id = cw.contact_id
                        JOIN 
                            positions p ON p.id = c.position_id
                        JOIN 
                            companies cp ON cp.id = c.company_id
                        JOIN 
                            company_work cpw ON cpw.company_id = c.company_id AND cpw.work_id = cw.work_id
                        WHERE 
                            cw.work_id = $data
                        GROUP BY 
                            cw.work_id,
                            c.id
                    ) c ON w.id = c.work_id
                LEFT JOIN 
                    positions p ON p.id = c.position_id
                LEFT JOIN 
                    companies cp ON cp.id = c.company_id 
                ORDER BY 
                    w.last_review DESC, 
                    w.name ASC
            ";
        
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
    public function returnCompanies($data) {
        $sql = "SELECT DISTINCT 
                cp.company_name, 
                cp.cnpj,
                af.description AS modalidadde
                FROM companies cp
                JOIN company_work cw ON cw.company_id = cp.id
                JOIN works w ON w.id = cw.work_id
                JOIN activity_field_work afw ON afw.company_id = cp.id
                JOIN activity_fields af ON af.id = afw.activity_field_id
                WHERE afw.work_id = $data ORDER BY w.last_review DESC";

        $results = \DB::select($sql);

        return $results;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $loggedUser = Auth::user();
        $statesVisible = session('statesVisible');
        $segmentSubTypesVisible = session('segmentSubTypesVisible');
        $startedAt = $this->searchParams['last_review_from_1'];
        $endsAt = $this->searchParams['last_review_to_1'];
        $name = $this->searchParams['name_1'];
        $investmentStandard = $this->searchParams['investment_standard_1'];
        $address = $this->searchParams['address_1'];
        $oldCode = $this->searchParams['old_code_1'];
        $district = $this->searchParams['district_1'];
        $researcher = $this->searchParams['researcher_id_1'];
        $modality = $this->searchParams['modality_id_1'];//Renato Machado 09/09/2023
        $floor = $this->searchParams['floor_1'];//Renato Machado 09/09/2023
        $stateAcronym = isset($this->searchParams['state_id_1'])
            ? $this->searchParams['state_id_1']
            : null;
        
        /*Cidades - Renato Machado 05/09/2023*/
        $cityIds = isset($this->searchParams['cities_ids_1']) 
                ? explode(',', $this->searchParams['cities_ids_1']) 
                : [];
        
        // participating_company
        $search = isset($this->searchParams['search_1'])
            ? $this->searchParams['search_1']
            : null;
        
        $qi = $this->searchParams['qi_1'];
        $price = $this->searchParams['price_1'];
        $qr = $this->searchParams['qr_1'];
        $revision = $this->searchParams['revision_1'];
        $qa = $this->searchParams['qa_1'];
        $totalArea = $this->searchParams['total_area_1'];

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

        // the session 'statesVisible' exists only for associate manager or associate user,
        // this filter covers the situation where the user hasn't selected any states
        if (session()->has('statesVisible') && (! isset($allStateIds))) {
            $states = $states->whereIn('id', $statesVisible);
        }

        // this filter covers the situation where the associate manager or associate user
        // has selected at least one state
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
        // Ends Region filters

        $works = $this->work
            ->select(
                'works.*',
                'phases.description AS phase_description',
                'stages.description AS stage_description',
                'segments.description AS segment_description',
                'segments.background AS segment_background',
                'segment_sub_types.description AS segment_sub_type_description',
            )
            ->join('phases', 'works.phase_id', '=', 'phases.id')
            ->join('stages', 'works.stage_id', '=', 'stages.id')
            ->join('segments', 'works.segment_id', '=', 'segments.id')
            ->join('segment_sub_types', 'works.segment_sub_type_id', '=', 'segment_sub_types.id')
            ->where('works.status', '!=', 0) 
            ->orderBy('last_review', 'desc')
            ->orderBy('name', 'asc');

        if ($search) {
            $works = $works->whereHas('companies', function ($q) use ($search) {
                return $q->where(
                    'companies.trading_name', $search
                );
            });
        }

        $allWorkIds = null;
        if (
            (session()->has($this->worksSessionName) || isset($this->searchParams['works_selected']))
            && (! Route::is('work.search.step_two.index'))
        ) {
            $allWorkIds = session()->has($this->worksSessionName)
                ? session($this->worksSessionName)
                : $this->searchParams['works_selected'];
            $works = $works->whereIn('works.id', $allWorkIds);
        }

        if ($allStatesAcronym) {
            $works = $works->whereIn('works.state', $allStatesAcronym);
        }

        $allStageIds = null;
        if (session()->has($this->stagesSessionName) || isset($this->searchParams['stages'])) {
            $allStageIds = session()->has($this->stagesSessionName)
                ? session($this->stagesSessionName)
                : $this->searchParams['stages'];
            $works = $works->whereIn('stages.id', $allStageIds);
        }

        // Segment Sub Types filters
        $allSegmentSubTypeIds = null;
        if (session()->has($this->segmentSubTypesSessionName) || isset($this->searchParams['segment_sub_types'])) {
            $allSegmentSubTypeIds = session()->has($this->segmentSubTypesSessionName)
                ? session($this->segmentSubTypesSessionName)
                : $this->searchParams['segment_sub_types'];
        }

        if ((! session()->has('segmentSubTypesVisible')) && isset($allSegmentSubTypeIds)) {
            $works = $works->whereIn('segment_sub_types.id', $allSegmentSubTypeIds);
        }
        
        if (session()->has('segmentSubTypesVisible') && (! isset($allSegmentSubTypeIds))) {
            $works = $works
                ->whereIn('segment_sub_types.id', $segmentSubTypesVisible->toArray());
        }

        // this filter covers the situation where the associate manager or associate user
        // has selected at least one segment subtype
        if (session()->has('segmentSubTypesVisible') && isset($allSegmentSubTypeIds)) {
            $segmentSubTypeToSearch = [];
            foreach ($segmentSubTypesVisible as $segmentSubTypeVisible) {
                if (in_array($segmentSubTypeVisible, $allSegmentSubTypeIds)) {
                    array_push($segmentSubTypeToSearch, $segmentSubTypeVisible);
                }
            }
            $works = $works->whereIn('segment_sub_types.id', $segmentSubTypeToSearch);
        }
        // Ends Segment Sub Types filters

        /*Nome da Obra*/
        if ($name) {
            $works = $works->where('works.name', 'LIKE', '%'.$name.'%');
        }
        
        /*Padrão investimento*/
        if ($investmentStandard) {
            $works = $works->where('works.investment_standard', $investmentStandard);
        }
        
        /*Endereço*/
        if ($address) {
            $works = $works->where('works.address', 'LIKE', '%'.$address.'%');
        }
        
        /*Código da obra*/
        if ($oldCode) {
            $oldCodes = explode(',', $oldCode); // Transforma a string de códigos em um array
            $works = $works->whereIn('works.old_code', $oldCodes);
        }
        
        /*Bairro*/
        if ($district) {
            $works = $works->where('works.district', 'LIKE', '%'.$district.'%');
        }

        /*State*/
        if ($stateAcronym) {
            $works = $works->where('works.state', '=', $stateAcronym);
        }
        
        /*City*/
        if (!empty($cityIds)) {
            // Busque as cidades com base nos IDs
            $cities = $this->city->findOrFail($cityIds);

            // Extraia as descrições das cidades para filtragem
            $cityDescriptions = $cities->pluck('description')->toArray();

            // Use as descrições das cidades para filtrar os trabalhos
            $works = $works->whereIn('works.city', $cityDescriptions);
        }
        
        /*Pesquisador*/
//        if ($researcher) {
//            $works = $works->where('works.updated_by', $researcher);
//        }
        
        if ($researcher) {
            $works = $works
            ->join('researcher_work as rw', 'rw.work_id', '=', 'works.id')
            ->join('researchers as r', 'r.id', '=', 'rw.researcher_id')
            ->where('rw.researcher_id', '=', $researcher);
        }
        
         /*Modalidade*/
        if ($modality) {
            $works = $works->whereHas('companies', function ($q) use ($modality) {
                return $q->where(
                    'companies.activity_field_id', $modality
                );
            });
        }
        
        /*Pavimento*/
        if ($floor) {
            $works = $works->where('works.floor', $floor);
        }
        
        
        /* Investimento */
        if ($qi && $price !== null) {
            // Convertendo valor monetário do formato brasileiro para numérico
            $price = str_replace(['.', ','], ['', '.'], $price);

            $works = $works->where(function($query) use ($qi, $price) {
                if ($qi == '>') {
                    $query->where('works.price', '>', $price);
                } elseif ($qi == '<') {
                    $query->where('works.price', '<', $price);
                }
            });
        }

        /* Revision */
        if ($qr && $revision !== null) {
            $works = $works->where(function($query) use ($qr, $revision) {
                if ($qr == '>') {
                    $query->where('works.revision', '>=', $revision);
                } elseif ($qr == '<') {
                    $query->where('works.revision', '<=', $revision);
                }
            });
        }
        
        /* Área Construída */
        if ($qa && $totalArea !== null) {
            $works = $works->where(function($query) use ($qa, $totalArea) {
                if ($qa == '>') {
                    $query->where('works.total_area', '>', $totalArea);
                } elseif ($qa == '<') {
                    $query->where('works.total_area', '<', $totalArea);
                }
            });
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

            // Final criteria initialization.
            $dataFilterStartsAtFinal = $dataFilterStartsAt1;
            $dataFilterEndsAtFinal = $dataFilterEndsAt1;

            // Date verification informed by associate members
            if ($startedAt && $endsAt) {

                // Filter dt ini >= $dataFilterStartsAt1? yes, so it is on the associate period range
                $dataFilterStartsAtFinal = ($startedAt >= $dataFilterStartsAt1)
                    ? $startedAt
                    : $dataFilterStartsAt1;

                // Filter dt end <= $dataFilterEndsAt1? yes, so it is on the associate period range
                $dataFilterEndsAtFinal = ($endsAt <= $dataFilterEndsAt1)
                    ? $endsAt
                    : $dataFilterEndsAt1;
            }
        }

        if ($dataFilterStartsAtFinal || $dataFilterEndsAtFinal) {
            $works = $works->whereBetween(
                'works.last_review', [$dataFilterStartsAtFinal, $dataFilterEndsAtFinal]
            );
        }

        return $works
            ->limit(500)
            ->get()
            ->map(function ($work) {
                $contacts = $this->returnContacts($work->id);
                $companies = $work->companies;

                $contactColumns = [];
                $index = 0;
                foreach ($contacts as $contact) {
                    $index++;
                    $contactColumns["contact_{$index}_name"] = $contact->name;
                    $contactColumns["contact_{$index}_email"] = $contact->email;
                    $contactColumns["contact_{$index}_secondary_email"] = $contact->secondary_email;
                    $contactColumns["contact_{$index}_tertiary_email"] = $contact->tertiary_email;
                    $contactColumns["contact_{$index}_ddd"] = $contact->ddd;
                    $contactColumns["contact_{$index}_main_phone"] = $contact->main_phone;
                    $contactColumns["contact_{$index}_ddd_two"] = $contact->ddd_two;
                    $contactColumns["contact_{$index}_phone_two"] = $contact->phone_two;
                    $contactColumns["contact_{$index}_ddd_three"] = $contact->ddd_three;
                    $contactColumns["contact_{$index}_phone_three"] = $contact->phone_three;
                    $contactColumns["contact_{$index}_ddd_four"] = $contact->ddd_four;
                    $contactColumns["contact_{$index}_phone_four"] = $contact->phone_four;
                    $contactColumns["contact_{$index}_position"] = $contact->position;
                    $contactColumns["contact_{$index}_fantasy"] = $contact->fantasy;
                    $contactColumns["contact_{$index}_cnpj"] = $contact->cnpj;
                }

                $contactData = [];
                for ($i = 1; $i <= 10; $i++) {
                    $contactData["contact_name_{$i}"] = $contactColumns["contact_{$i}_name"] ?? null;
                    $contactData["contact_email_{$i}"] = $contactColumns["contact_{$i}_email"] ?? null;
                    $contactData["contact_secondary_email_{$i}"] = $contactColumns["contact_{$i}_secondary_email"] ?? null;
                    $contactData["contact_tertiary_email_{$i}"] = $contactColumns["contact_{$i}_tertiary_email"] ?? null;
                    $contactData["contact_ddd_{$i}"] = $contactColumns["contact_{$i}_ddd"] ?? null;
                    $contactData["contact_main_phone_{$i}"] = $contactColumns["contact_{$i}_main_phone"] ?? null;
                    $contactData["contact_ddd_two_{$i}"] = $contactColumns["contact_{$i}_ddd_two"] ?? null;
                    $contactData["contact_phone_two_{$i}"] = $contactColumns["contact_{$i}_phone_two"] ?? null;
                    $contactData["contact_ddd_three_{$i}"] = $contactColumns["contact_{$i}_ddd_three"] ?? null;
                    $contactData["contact_phone_three_{$i}"] = $contactColumns["contact_{$i}_phone_three"] ?? null;
                    $contactData["contact_ddd_four_{$i}"] = $contactColumns["contact_{$i}_ddd_four"] ?? null;
                    $contactData["contact_phone_four_{$i}"] = $contactColumns["contact_{$i}_phone_fou"] ?? null;
                    $contactData["contact_position_{$i}"] = $contactColumns["contact_{$i}_position"] ?? null;
                    $contactData["contact_fantasy_{$i}"] = $contactColumns["contact_{$i}_fantasy"] ?? null;
                    $contactData["contact_cnpj_{$i}"] = $contactColumns["contact_{$i}_cnpj"] ?? null;
                }

                $companyColumns = [];
                $index = 0;
                foreach ($companies as $company) {
                    $index++;
                    $companyColumns["company_{$index}_company_name"] = $company->company_name;
                    $companyColumns["company_{$index}_modalidadde"] = $company->modalidadde;
                    $companyColumns["company_{$index}_cnpj"] = $company->cnpj;
                }

                $companyData = [];
                for ($i = 1; $i <= 10; $i++) {
                    $companyData["company_company_name_{$i}"] = $companyColumns["company_{$i}_company_name"] ?? null;
                    $companyData["company_modalidadde_{$i}"] = $companyColumns["company_{$i}_modalidadde"] ?? null;
                    $companyData["company_cnpj_{$i}"] = $companyColumns["company_{$i}_cnpj"] ?? null;
                }

                // Área de Lazer
                $workFeatures = (new WorkFeature)
                    ->orderBy('description', 'asc')
                    ->get();

                $workFeaturesForSpreadsheet = [];
                foreach ($workFeatures as $workFeature) {
                    if ($work->features->contains($workFeature)) {
                        array_push(
                            $workFeaturesForSpreadsheet,
                            $workFeature->description
                        );
                    }
                }
                $workFeaturesSpliced = implode(', ', $workFeaturesForSpreadsheet);
                // Fim Área de Lazer

                return [
                    $work->old_code, // Código
                    optional($work->last_review)->format(self::DATE_FORMAT), // Data da última atualização
                    $work->revision, // Nº de revisão
                    $work->name, // Nome da Obra
                    $work->price, // Valor do Investimento R$
                    $work->investment_standard, // Padrão de investimento
                    $work->total_project_area, // Área Total do Projeto
                    $work->address, // Endereço
                    $work->number, // Nº
                    $work->district, // Bairro
                    $work->zip_code, // Cep
                    $work->city, // Cidade
                    $work->state, // Estado
                    optional($work->started_at)->format(self::DATE_FORMAT), // Início da Obra
                    optional($work->ends_at)->format(self::DATE_FORMAT), // Término da Obra
                    $work->start_and_end, // Início / Término
                    optional($work->stage)->description, // Estágio Atual
                    optional($work->phase)->description, // Fase
                    optional($work->segment)->description, // Segmento de Atuação
                    optional($work->segmentSubType)->description, // Subtipo
                    $work->tower, // N° de Edifícios
                    $work->house, // Casas
                    $work->condominium, // Cond. de Casas
                    $work->floor, // Nº de Pavimentos
                    $work->apartment_per_floor, // Apart./Salas por Andar
                    $work->bedroom, // Dormitórios
                    $work->suite, // Suítes
                    $work->bathroom, // Banheiros
                    $work->washbasin, // Lavabos
                    $work->living_room, // Sala de Jantar/Estar
                    $work->service_area_terrace_balcony, // Área de Serviço/Terraço/Varanda
                    $work->cup_and_kitchen, // Copas/Cozinhas
                    $work->maid_dependency, // Dependência de Empregada
                    $work->total_unities, // Total de Unidades
                    $work->useful_area, // Área Útil (m²)
                    $work->total_area, // Área do Terreno (m²)
                    $work->elevator, // Elevador
                    $work->garage, // Vagas
                    $work->air_conditioner, // Ar Condicionado
                    $work->heating, // Aquecimento
                    $work->foundry, // Fundações
                    $work->frame, // Estrutura
                    $work->completion, // Acabamento
                    $work->facade, // Fachada
                    $workFeaturesSpliced, // Área de Lazer
                    $work->other_leisure, // Outros Lazer
                    $work->notes, // Descrições Complementares

                    // Adicione os dados de contato usando o array contactData
                    $contactData["contact_name_1"],
                    $contactData["contact_position_1"],
                    implode(' / ', array_filter([$contactData["contact_email_1"], $contactData["contact_secondary_email_1"], $contactData["contact_tertiary_email_1"]])),

                    (!empty($contactData["contact_ddd_1"]) && !empty($contactData["contact_main_phone_1"]) ? '(' . $contactData["contact_ddd_1"] . ')' . $contactData["contact_main_phone_1"] : '') .
                    (!empty($contactData["contact_ddd_two_1"]) && !empty($contactData["contact_phone_two_1"]) ? ' / (' . $contactData["contact_ddd_two_1"] . ')' . $contactData["contact_phone_two_1"] : '') .
                    (!empty($contactData["contact_ddd_three_1"]) && !empty($contactData["contact_phone_three_1"]) ? ' / (' . $contactData["contact_ddd_three_1"] . ')' . $contactData["contact_phone_three_1"] : '') .
                    (!empty($contactData["contact_ddd_four_1"]) && !empty($contactData["contact_phone_four_1"]) ? ' / (' . $contactData["contact_ddd_four_1"] . ')' . $contactData["contact_phone_four_1"] : ''),

                    $contactData["contact_fantasy_1"],
                    $contactData["contact_cnpj_1"],

                    $contactData["contact_name_2"],
                    $contactData["contact_position_2"],
                    implode(' / ', array_filter([$contactData["contact_email_2"], $contactData["contact_secondary_email_2"], $contactData["contact_tertiary_email_2"]])),

                    (!empty($contactData["contact_ddd_2"]) && !empty($contactData["contact_main_phone_2"]) ? '(' . $contactData["contact_ddd_2"] . ')' . $contactData["contact_main_phone_2"] : '') .
                    (!empty($contactData["contact_ddd_two_2"]) && !empty($contactData["contact_phone_two_2"]) ? ' / (' . $contactData["contact_ddd_two_2"] . ')' . $contactData["contact_phone_two_2"] : '') .
                    (!empty($contactData["contact_ddd_three_2"]) && !empty($contactData["contact_phone_three_2"]) ? ' / (' . $contactData["contact_ddd_three_2"] . ')' . $contactData["contact_phone_three_2"] : '') .
                    (!empty($contactData["contact_ddd_four_2"]) && !empty($contactData["contact_phone_four_2"]) ? ' / (' . $contactData["contact_ddd_four_2"] . ')' . $contactData["contact_phone_four_2"] : ''),

                    $contactData["contact_fantasy_2"],
                    $contactData["contact_cnpj_2"],

                    $contactData["contact_name_3"],
                    $contactData["contact_position_3"],
                    implode(' / ', array_filter([$contactData["contact_email_3"], $contactData["contact_secondary_email_3"], $contactData["contact_tertiary_email_3"]])),

                    (!empty($contactData["contact_ddd_3"]) && !empty($contactData["contact_main_phone_3"]) ? '(' . $contactData["contact_ddd_3"] . ')' . $contactData["contact_main_phone_3"] : '') .
                    (!empty($contactData["contact_ddd_two_3"]) && !empty($contactData["contact_phone_two_3"]) ? ' / (' . $contactData["contact_ddd_two_3"] . ')' . $contactData["contact_phone_two_3"] : '') .
                    (!empty($contactData["contact_ddd_three_3"]) && !empty($contactData["contact_phone_three_3"]) ? ' / (' . $contactData["contact_ddd_three_3"] . ')' . $contactData["contact_phone_three_3"] : '') .
                    (!empty($contactData["contact_ddd_four_3"]) && !empty($contactData["contact_phone_four_3"]) ? ' / (' . $contactData["contact_ddd_four_3"] . ')' . $contactData["contact_phone_four_3"] : ''),

                    $contactData["contact_fantasy_3"],
                    $contactData["contact_cnpj_3"],

                    $contactData["contact_name_4"],
                    $contactData["contact_position_4"],
                    implode(' / ', array_filter([$contactData["contact_email_4"], $contactData["contact_secondary_email_4"], $contactData["contact_tertiary_email_4"]])),

                    (!empty($contactData["contact_ddd_4"]) && !empty($contactData["contact_main_phone_4"]) ? '(' . $contactData["contact_ddd_4"] . ')' . $contactData["contact_main_phone_4"] : '') .
                    (!empty($contactData["contact_ddd_two_4"]) && !empty($contactData["contact_phone_two_4"]) ? ' / (' . $contactData["contact_ddd_two_4"] . ')' . $contactData["contact_phone_two_4"] : '') .
                    (!empty($contactData["contact_ddd_three_4"]) && !empty($contactData["contact_phone_three_4"]) ? ' / (' . $contactData["contact_ddd_three_4"] . ')' . $contactData["contact_phone_three_4"] : '') .
                    (!empty($contactData["contact_ddd_four_4"]) && !empty($contactData["contact_phone_four_4"]) ? ' / (' . $contactData["contact_ddd_four_4"] . ')' . $contactData["contact_phone_four_4"] : ''),

                    $contactData["contact_fantasy_4"],
                    $contactData["contact_cnpj_4"],

                    $contactData["contact_name_5"],
                    $contactData["contact_position_5"],
                    implode(' / ', array_filter([$contactData["contact_email_5"], $contactData["contact_secondary_email_5"], $contactData["contact_tertiary_email_5"]])),

                    (!empty($contactData["contact_ddd_5"]) && !empty($contactData["contact_main_phone_5"]) ? '(' . $contactData["contact_ddd_5"] . ')' . $contactData["contact_main_phone_5"] : '') .
                    (!empty($contactData["contact_ddd_two_5"]) && !empty($contactData["contact_phone_two_5"]) ? ' / (' . $contactData["contact_ddd_two_5"] . ')' . $contactData["contact_phone_two_5"] : '') .
                    (!empty($contactData["contact_ddd_three_5"]) && !empty($contactData["contact_phone_three_5"]) ? ' / (' . $contactData["contact_ddd_three_5"] . ')' . $contactData["contact_phone_three_5"] : '') .
                    (!empty($contactData["contact_ddd_four_5"]) && !empty($contactData["contact_phone_four_5"]) ? ' / (' . $contactData["contact_ddd_four_5"] . ')' . $contactData["contact_phone_four_5"] : ''),

                    $contactData["contact_fantasy_5"],
                    $contactData["contact_cnpj_5"],

                    $contactData["contact_name_6"],
                    $contactData["contact_position_6"],
                    implode(' / ', array_filter([$contactData["contact_email_6"], $contactData["contact_secondary_email_6"], $contactData["contact_tertiary_email_6"]])),

                    (!empty($contactData["contact_ddd_6"]) && !empty($contactData["contact_main_phone_6"]) ? '(' . $contactData["contact_ddd_6"] . ')' . $contactData["contact_main_phone_6"] : '') .
                    (!empty($contactData["contact_ddd_two_6"]) && !empty($contactData["contact_phone_two_6"]) ? ' / (' . $contactData["contact_ddd_two_6"] . ')' . $contactData["contact_phone_two_6"] : '') .
                    (!empty($contactData["contact_ddd_three_6"]) && !empty($contactData["contact_phone_three_6"]) ? ' / (' . $contactData["contact_ddd_three_6"] . ')' . $contactData["contact_phone_three_6"] : '') .
                    (!empty($contactData["contact_ddd_four_6"]) && !empty($contactData["contact_phone_four_6"]) ? ' / (' . $contactData["contact_ddd_four_6"] . ')' . $contactData["contact_phone_four_6"] : ''),

                    $contactData["contact_fantasy_6"],
                    $contactData["contact_cnpj_6"],

                    $contactData["contact_name_7"],
                    $contactData["contact_position_7"],
                    implode(' / ', array_filter([$contactData["contact_email_7"], $contactData["contact_secondary_email_7"], $contactData["contact_tertiary_email_7"]])),

                    (!empty($contactData["contact_ddd_7"]) && !empty($contactData["contact_main_phone_7"]) ? '(' . $contactData["contact_ddd_7"] . ')' . $contactData["contact_main_phone_7"] : '') .
                    (!empty($contactData["contact_ddd_two_7"]) && !empty($contactData["contact_phone_two_7"]) ? ' / (' . $contactData["contact_ddd_two_7"] . ')' . $contactData["contact_phone_two_7"] : '') .
                    (!empty($contactData["contact_ddd_three_7"]) && !empty($contactData["contact_phone_three_7"]) ? ' / (' . $contactData["contact_ddd_three_7"] . ')' . $contactData["contact_phone_three_7"] : '') .
                    (!empty($contactData["contact_ddd_four_7"]) && !empty($contactData["contact_phone_four_7"]) ? ' / (' . $contactData["contact_ddd_four_7"] . ')' . $contactData["contact_phone_four_7"] : ''),

                    $contactData["contact_fantasy_7"],
                    $contactData["contact_cnpj_7"],

                    $contactData["contact_name_8"],
                    $contactData["contact_position_8"],
                    implode(' / ', array_filter([$contactData["contact_email_8"], $contactData["contact_secondary_email_8"], $contactData["contact_tertiary_email_8"]])),

                    (!empty($contactData["contact_ddd_8"]) && !empty($contactData["contact_main_phone_8"]) ? '(' . $contactData["contact_ddd_8"] . ')' . $contactData["contact_main_phone_8"] : '') .
                    (!empty($contactData["contact_ddd_two_8"]) && !empty($contactData["contact_phone_two_8"]) ? ' / (' . $contactData["contact_ddd_two_8"] . ')' . $contactData["contact_phone_two_8"] : '') .
                    (!empty($contactData["contact_ddd_three_8"]) && !empty($contactData["contact_phone_three_8"]) ? ' / (' . $contactData["contact_ddd_three_8"] . ')' . $contactData["contact_phone_three_8"] : '') .
                    (!empty($contactData["contact_ddd_four_8"]) && !empty($contactData["contact_phone_four_8"]) ? ' / (' . $contactData["contact_ddd_four_8"] . ')' . $contactData["contact_phone_four_8"] : ''),

                    $contactData["contact_fantasy_8"],
                    $contactData["contact_cnpj_8"],

                    $contactData["contact_name_9"],
                    $contactData["contact_position_9"],
                    implode(' / ', array_filter([$contactData["contact_email_9"], $contactData["contact_secondary_email_9"], $contactData["contact_tertiary_email_9"]])),

                    (!empty($contactData["contact_ddd_9"]) && !empty($contactData["contact_main_phone_9"]) ? '(' . $contactData["contact_ddd_9"] . ')' . $contactData["contact_main_phone_9"] : '') .
                    (!empty($contactData["contact_ddd_two_9"]) && !empty($contactData["contact_phone_two_9"]) ? ' / (' . $contactData["contact_ddd_two_9"] . ')' . $contactData["contact_phone_two_9"] : '') .
                    (!empty($contactData["contact_ddd_three_9"]) && !empty($contactData["contact_phone_three_9"]) ? ' / (' . $contactData["contact_ddd_three_9"] . ')' . $contactData["contact_phone_three_9"] : '') .
                    (!empty($contactData["contact_ddd_four_9"]) && !empty($contactData["contact_phone_four_9"]) ? ' / (' . $contactData["contact_ddd_four_9"] . ')' . $contactData["contact_phone_four_9"] : ''),

                    $contactData["contact_fantasy_9"],
                    $contactData["contact_cnpj_9"],  

                    $contactData["contact_name_10"],
                    $contactData["contact_position_10"],
                    implode(' / ', array_filter([$contactData["contact_email_10"], $contactData["contact_secondary_email_10"], $contactData["contact_tertiary_email_10"]])),

                    (!empty($contactData["contact_ddd_10"]) && !empty($contactData["contact_main_phone_10"]) ? '(' . $contactData["contact_ddd_10"] . ')' . $contactData["contact_main_phone_10"] : '') .
                    (!empty($contactData["contact_ddd_two_10"]) && !empty($contactData["contact_phone_two_10"]) ? ' / (' . $contactData["contact_ddd_two_10"] . ')' . $contactData["contact_phone_two_10"] : '') .
                    (!empty($contactData["contact_ddd_three_10"]) && !empty($contactData["contact_phone_three_10"]) ? ' / (' . $contactData["contact_ddd_three_10"] . ')' . $contactData["contact_phone_three_10"] : '') .
                    (!empty($contactData["contact_ddd_four_10"]) && !empty($contactData["contact_phone_four_10"]) ? ' / (' . $contactData["contact_ddd_four_10"] . ')' . $contactData["contact_phone_four_10"] : ''),

                    $contactData["contact_fantasy_10"],
                    $contactData["contact_cnpj_10"],


                    // Adicione os dados de empresas participantes usando o array companytData
                    $companyData["company_company_name_1"],
                    $companyData["company_modalidadde_1"],
                    $companyData["company_cnpj_1"],

                    $companyData["company_company_name_2"],
                    $companyData["company_modalidadde_2"],
                    $companyData["company_cnpj_2"],

                    $companyData["company_company_name_3"],
                    $companyData["company_modalidadde_3"],
                    $companyData["company_cnpj_3"],

                    $companyData["company_company_name_4"],
                    $companyData["company_modalidadde_4"],
                    $companyData["company_cnpj_4"],

                    $companyData["company_company_name_5"],
                    $companyData["company_modalidadde_5"],
                    $companyData["company_cnpj_5"],

                    $companyData["company_company_name_6"],
                    $companyData["company_modalidadde_6"],
                    $companyData["company_cnpj_6"],

                    $companyData["company_company_name_7"],
                    $companyData["company_modalidadde_7"],
                    $companyData["company_cnpj_7"],

                    $companyData["company_company_name_8"],
                    $companyData["company_modalidadde_8"],
                    $companyData["company_cnpj_8"],

                    $companyData["company_company_name_9"],
                    $companyData["company_modalidadde_9"],
                    $companyData["company_cnpj_9"],

                    $companyData["company_company_name_10"],
                    $companyData["company_modalidadde_10"],
                    $companyData["company_cnpj_10"],

                ];
            });
    }

    public function headings(): array {
        return [
            /* Dados da obra */
            'Código',
            'Data da última atualização',
            'Nº de revisão',
            'Nome da Obra',
            'Valor do Investimento R$',
            'Padrão de investimento',
            'Área total construída (m2)',
            'Endereço',
            'Nº',
            'Bairro',
            'Cep',
            'Cidade',
            'Estado',
            'Início da Obra',
            'Término da Obra',
            'Início / Término',
            'Estágio Atual',
            'Fase',
            'Segmento de Atuação',
            'Subtipo',
            'N° de Edifícios',
            'Casas',
            'Cond. de Casas',
            'Nº de Pavimentos',
            'Apart./Salas por Andar',
            'Dormitórios',
            'Suítes',
            'Banheiros',
            'Lavabos',
            'Sala de Jantar/Estar',
            'Área de Serviço/Terraço/Varanda',
            'Copas/Cozinhas',
            'Dependência de Empregada',
            'Total de Unidades',
            'Área Útil (m²)',
            'Área do Terreno (m²)',
            'Elevador',
            'Vagas',
            'Ar Condicionado',
            'Aquecimento',
            'Fundações',
            'Estrutura',
            'Acabamento',
            'Fachada',
            'Área de lazer',
            'Outros Lazer',
            'Detalhes', // Descrições Complementares

            /* Contatos */
            'Nome do Contato 1',
            'Cargo 1',
            'Email do Contato 1',
            'Telefone do Contato 1',
            'Nome Fantasia da Empresa 1',
            'CNPJ 1',
            
            'Nome do Contato 2',
            'Cargo 2',
            'Email do Contato 2',
            'Telefone do Contato 2',
            'Nome Fantasia da Empresa 2',
            'CNPJ 2',
         
            'Nome do Contato 3',
            'Cargo 3',
            'Email do Contato 3',
            'Telefone do Contato 3',
            'Nome Fantasia da Empresa 3',
            'CNPJ 3',
           
            'Nome do Contato 4',
            'Cargo 4',
            'Email do Contato 4',
            'Telefone do Contato 4',
            'Nome Fantasia da Empresa 4',
            'CNPJ 4',
            
            'Nome do Contato 5',
            'Cargo 5',
            'Email do Contato 5',
            'Telefone do Contato 5',
            'Nome Fantasia da Empresa 5',
            'CNPJ 5',
            
            'Nome do Contato 6',
            'Cargo 6',
            'Email do Contato 6',
            'Telefone do Contato 6',
            'Nome Fantasia da Empresa 6',
            'CNPJ 6',
            
            'Nome do Contato 7',
            'Cargo 7',
            'Email do Contato 7',
            'Telefone do Contato 7',
            'Nome Fantasia da Empresa 7',
            'CNPJ 7',
            
            'Nome do Contato 8',
            'Cargo 8',
            'Email do Contato 8',
            'Telefone do Contato 8',
            'Nome Fantasia da Empresa 8',
            'CNPJ 8',
            
            'Nome do Contato 9',
            'Cargo 9',
            'Email do Contato 9',
            'Telefone do Contato 9',
            'Nome Fantasia da Empresa 9',
            'CNPJ 9',
            
            'Nome do Contato 10',
            'Cargo 10',
            'Email do Contato 10',
            'Telefone do Contato 10',
            'Nome Fantasia da Empresa 10',
            'CNPJ 10',
            
            /* Empresas participantes */
            'Nome Fantasia da Empresa Participante 1',
            'Modalidade 1',
            'CNPJ 1',
            
            'Nome Fantasia da Empresa Participante 2',
            'Modalidade 2',
            'CNPJ 2',
            
            'Nome Fantasia da Empresa Participante 3',
            'Modalidade 3',
            'CNPJ 3',
            
            'Nome Fantasia da Empresa Participante 4',
            'Modalidade 4',
            'CNPJ 4',
            
            'Nome Fantasia da Empresa Participante 5',
            'Modalidade 5',
            'CNPJ 5',
            
            'Nome Fantasia da Empresa Participante 6',
            'Modalidade 6',
            'CNPJ 6',
            
            'Nome Fantasia da Empresa Participante 7',
            'Modalidade 7',
            'CNPJ 7',
            
            'Nome Fantasia da Empresa Participante 8',
            'Modalidade 8',
            'CNPJ 8',
            
            'Nome Fantasia da Empresa Participante 9',
            'Modalidade 9',
            'CNPJ 9',
            
            'Nome Fantasia da Empresa Participante 10',
            'Modalidade 10',
            'CNPJ 10',
        ];
    }
}
