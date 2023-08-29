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
    public function returnContacts($data) {

        $sql = "SELECT
                w.id,
                w.name
                as work,
                c.name,
                c.email,
                c.ddd,
                c.main_phone,
                p.description as position
                FROM works w
                JOIN  contact_work cw ON cw.work_id = w.id
                LEFT JOIN contacts c ON c.id = cw.contact_id
                JOIN positions p ON p.id = c.position_id
                WHERE w.id = $data";
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
        $segmentSubTypesVisible = session('segmentSubTypesVisible');
        $startedAt = $this->searchParams['last_review_from_1'];
        $endsAt = $this->searchParams['last_review_to_1'];
        $name = $this->searchParams['name_1'];
        $investmentStandard = $this->searchParams['investment_standard_1'];
        $address = $this->searchParams['address_1'];
        $oldCode = $this->searchParams['old_code_1'];
        $district = $this->searchParams['district_1'];
        $stateAcronym = isset($this->searchParams['state_id'])
            ? $this->searchParams['state_id']
            : null;
        $cityId = isset($this->searchParams['city_id'])
            ? $this->searchParams['city_id']
            : null;
        $participatingCompany = $this->searchParams['participating_company_1'];
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

        // this session exists only for associate manager or associate user
        if (session()->has('statesVisible') && isset($allStateIds)) {
            $states = $states->whereIn('id', $allStateIds);
        }

        if (session()->has('statesVisible') && (! isset($allStateIds))) {
            $states = $states->whereIn('id', $statesVisible);
        }

        $allStatesAcronym = $states->get()->pluck('state_acronym');
        // Ends Region filters

        $works = $this->work
            ->select(
                'works.*',
                'phases.description AS phase_description',
                'stages.description AS stage_description',
                'segments.description AS segment_description',
                'segment_sub_types.description AS segment_sub_type_description',
            )
            ->join('phases', 'works.phase_id', '=', 'phases.id')
            ->join('stages', 'works.stage_id', '=', 'stages.id')
            ->join('segments', 'works.segment_id', '=', 'segments.id')
            ->join('segment_sub_types', 'works.segment_sub_type_id', '=', 'segment_sub_types.id');

        if ($participatingCompany) {
            $works = $works->whereHas('companies', function ($q) use ($participatingCompany) {
                return $q->where(
                    'companies.company_name', 'LIKE', '%'.$participatingCompany.'%'
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

        if (session()->has('segmentSubTypesVisible') && isset($allSegmentSubTypeIds)) {
            $works = $works->whereIn('segment_sub_types.id', $allSegmentSubTypeIds);
        }
        
        if (session()->has('segmentSubTypesVisible') && (! isset($allSegmentSubTypeIds))) {
            $works = $works
                ->whereIn('segment_sub_types.id', $segmentSubTypesVisible->toArray());
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
        if ($cityId) {
            $city = $this->city->findOrFail($cityId);
            $works = $works->where('works.city', 'LIKE', '%'.$city->description.'%');
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

                $companyColumns = [];
                $index = 0;
                foreach ($companies as $company) {
                    $index++;
                    $companyColumns["company_{$index}_company_name"] = $company->company_name;
                    $companyColumns["company_{$index}_activity_field"]
                        = optional($company->activityField)->description;
                    $companyColumns["company_{$index}_cnpj"] = $company->cnpj;
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

                    $companyData["company_company_name_1"],
                    $companyData["company_activity_field_1"], // Modalidade / Atividade
                    $companyData["company_cnpj_1"],

                    $companyData["company_company_name_2"],
                    $companyData["company_activity_field_2"],
                    $companyData["company_cnpj_2"],

                    $companyData["company_company_name_3"],
                    $companyData["company_activity_field_3"],
                    $companyData["company_cnpj_3"],
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
            'Área Total do Projeto',
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
        ];
    }
}
