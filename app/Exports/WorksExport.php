<?php

namespace App\Exports;
use App\Models\Work;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class WorksExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles {
    
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
    public function returnContacts($data) {

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
            FROM works w 
            JOIN contact_work cw ON cw.work_id = w.id
            LEFT JOIN contacts c ON c.id = cw.contact_id
            JOIN positions p ON p.id = c.position_id
            JOIN companies cp ON cp.id = c.company_id
            JOIN company_work cpw ON cpw.company_id = c.company_id AND cpw.work_id = w.id
            WHERE w.id = $data
            GROUP BY 
                    w.id, 
                    w.name,
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
                    p.description,
                    cp.trading_name ,
                    cp.cnpj 
            ORDER BY w.last_review DESC, w.name ASC
            ";

        $results = \DB::select($sql);
        
        return $results;
    } 
    
    /*Aerea de lazer*/
    public function returnLeisureAreas($data) {
        $sql = "SELECT DISTINCT
                wf.description AS feature
                FROM works w
                JOIN work_feature_work wfw ON wfw.work_id = w.id
                JOIN work_features wf ON wf.id = wfw.work_feature_id
                WHERE w.id = $data";

        $results = \DB::select($sql);

        return $results;
    }

    public function collection() {
        
        return Work::with(['segment', 'segmentSubType', 'stage', 'phase'])
                    ->whereBetween('last_review', [$this->startDate, $this->endDate])
                    ->orderBy('last_review', 'asc')
                    ->get()
                    ->map(function ($work) {
                        $contacts = $this->returnContacts($work->id);
                        $companies = $this->returnCompanies($work->id);
                        $leisureAreas = $this->returnLeisureAreas($work->id);

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
                        
                        $leisureAreaFeatures = '';
                        foreach ($leisureAreas as $leisureArea) {
                            $leisureAreaFeatures .= $leisureArea->feature . ', ';
                        }
                        $leisureAreaFeatures = rtrim($leisureAreaFeatures, ', ');
                        

                        return [
                            $work->old_code,
                            date('Y-m-d', strtotime($work->last_review)),
                            $work->revision,
                            $work->name,
                            number_format($work->price, 2, ',', '.'),
                            $work->investment_standard,
                            $work->total_project_area,
                            $work->address,
                            $work->number,        
                            $work->district,
                            $work->zip_code,
                            $work->city,
                            $work->state,
                            ($work->started_at) ? date('d/m/Y', strtotime($work->started_at)) : '',
                            ($work->ends_at) ? date('d/m/Y', strtotime($work->ends_at)) : '',
                            $work->start_and_end,
                            $work->stage->description,
                            $work->phase->description,
                            $work->segment->description,
                            $work->segmentSubType->description,
                            $work->tower,
                            $work->house,
                            $work->condominium,
                            $work->floor,
                            $work->apartment_per_floor,
                            $work->bedroom,
                            $work->suite,
                            $work->bathroom,
                            $work->washbasin,
                            $work->living_room,
                            $work->service_area_terrace_balcony,
                            $work->cup_and_kitchen,
                            $work->maid_dependency,
                            $work->total_unities,
                            $work->useful_area,
                            $work->total_area,
                            $work->elevator,
                            $work->garage,
                            $work->coverage,
                            $work->air_conditioner,
                            $work->heating,
                            $work->foundry,
                            $work->frame,
                            $work->completion,
                            $work->facade,

                            //Area de lazer
                            $leisureAreaFeatures, 
                            $work->other_leisure,
                            $work->notes,

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
            'Codigo',
            'Data da última atualização',
            'Nº de revisão',
            'Nome da Obra',
            'Valor do Investimeto R$',
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
            'Cobertura (m²)',
            'Ar Condicionado',
            'Aquecimento',
            'Fundações',
            'Estrutura',
            'Acabamento',
            'Fachada',
            'Área de lazer',
            'Outros Lazer',
            'Detalhes',
            
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
