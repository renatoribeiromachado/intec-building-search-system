<?php

namespace App\Exports;
use App\Models\Work;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

//use Maatwebsite\Excel\Concerns\WithTitle;

class WorksExport implements FromCollection, WithHeadings {
    
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => '#FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => '#0070C0',
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ];

            $event->sheet->getStyle('A1:AK1')->applyFromArray($styleArray);
            $event->sheet->getStyle('A1:AK1')->getAlignment()->setWrapText(true);
            $event->sheet->getStyle('A1:AK1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $event->sheet->getStyle('A1:AK1')->getFont()->setSize(10);

            // Ajuste automático da largura da coluna B com base no conteúdo
            $event->sheet->getColumnDimension('B')->setAutoSize(true);

            $event->sheet->getRowDimension(1)->setRowHeight(30);
        },
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
                WHERE afw.work_id = $data";

        $results = \DB::select($sql);

        return $results;
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
                            $contactColumns["contact_{$index}_ddd"] = $contact->ddd;
                            $contactColumns["contact_{$index}_main_phone"] = $contact->main_phone;
                            $contactColumns["contact_{$index}_position"] = $contact->position;
                        }

                        $contactData = [];
                        for ($i = 1; $i <= 3; $i++) {
                            $contactData["contact_name_{$i}"] = $contactColumns["contact_{$i}_name"] ?? null;
                            $contactData["contact_email_{$i}"] = $contactColumns["contact_{$i}_email"] ?? null;
                            $contactData["contact_ddd_{$i}"] = $contactColumns["contact_{$i}_ddd"] ?? null;
                            $contactData["contact_main_phone_{$i}"] = $contactColumns["contact_{$i}_main_phone"] ?? null;
                            $contactData["contact_position_{$i}"] = $contactColumns["contact_{$i}_position"] ?? null;
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
                        for ($i = 1; $i <= 3; $i++) {
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
                            $contactData["contact_email_1"],
                            ($contactData["contact_ddd_1"]), $contactData["contact_main_phone_1"],
                            
                            $contactData["contact_name_2"],
                            $contactData["contact_position_2"],
                            $contactData["contact_email_2"],
                            ($contactData["contact_ddd_2"]),$contactData["contact_main_phone_2"],
                            
                            $contactData["contact_name_3"],
                            $contactData["contact_position_3"],
                            $contactData["contact_email_3"],
                            ($contactData["contact_ddd_3"]), $contactData["contact_main_phone_3"],
                            
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
