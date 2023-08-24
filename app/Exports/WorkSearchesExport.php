<?php

namespace App\Exports;

use App\Models\Work;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class WorkSearchesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $searchParams;

    public function __construct($searchParams)
    {
        $this->searchParams = $searchParams;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function returnCompanies($data) {
        $sql = "SELECT DISTINCT
                cp.company_name,
                af.description AS modalidadde
                FROM companies cp
                JOIN company_work cw ON cw.company_id = cp.id
                JOIN works w ON w.id = cw.work_id
                JOIN activity_field_work afw ON afw.company_id = cp.id
                JOIN activity_fields af ON af.id = afw.activity_field_id
                WHERE afw.work_id = $data";

        $results = \DB::select($sql);
        // ->get();

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
        return Work::query()
            // ->when(isset($this->searchParams['_token']), function ($query) {
            //     return $query->where('_token', $this->searchParams['_token']);
            // })
            // ->when(isset($this->searchParams['_method']), function ($query) {
            //     return $query->where('_method', $this->searchParams['_method']);
            // })
            // ->when(isset($this->searchParams['last_review_from']), function ($query) {
            //     return $query->where('last_review_from', $this->searchParams['last_review_from']);
            // })
            // ->when(isset($this->searchParams['last_review_to']), function ($query) {
            //     return $query->where('last_review_to', $this->searchParams['last_review_to']);
            // })
            // ->when(isset($this->searchParams['phases'][0]), function ($query) {
            //     return $query->where('phase', $this->searchParams['phases'][0]);
            // })
            // ->when(isset($this->searchParams['stages']), function ($query) {
            //     foreach ($this->searchParams['stages'] as $stage) {
            //         $query->where('stage', $stage);
            //     }
            //     return $query;
            // })
            // ->when(isset($this->searchParams['investment_standard']), function ($query) {
            //     return $query->where('investment_standard', $this->searchParams['investment_standard']);
            // })
            // ->when(isset($this->searchParams['name']), function ($query) {
            //     return $query->where('name', $this->searchParams['name']);
            // })
            // ->when(isset($this->searchParams['address']), function ($query) {
            //     return $query->where('address', $this->searchParams['address']);
            // })
            // Adicione mais condições aqui para os outros parâmetros

            ->get()
            ->map(function ($work) {
                $contacts = $this->returnContacts($work->id);
                $companies = $this->returnCompanies($work->id);

                $contactColumns = [];
                $index = 0;
                foreach ($contacts as $contact) {
                    $index++;
                    $contactColumns["contact_{$index}_name"] = $contact->name;
                    $contactColumns["contact_{$index}_email"] = $contact->email;
                    $contactColumns["contact_{$index}_ddd"] = $contact->ddd;
                    $contactColumns["contact_{$index}_main_phone"] = $contact->main_phone;
                }

                $contactData = [];
                for ($i = 1; $i <= 3; $i++) {
                    $contactData["contact_name_{$i}"] = $contactColumns["contact_{$i}_name"] ?? null;
                    $contactData["contact_email_{$i}"] = $contactColumns["contact_{$i}_email"] ?? null;
                    $contactData["contact_ddd_{$i}"] = $contactColumns["contact_{$i}_ddd"] ?? null;
                    $contactData["contact_main_phone_{$i}"] = $contactColumns["contact_{$i}_main_phone"] ?? null;
                }

                $companyColumns = [];
                $index = 0;
                foreach ($companies as $company) {
                    $index++;
                    $companyColumns["company_{$index}_company_name"] = $company->company_name;
                    $companyColumns["company_{$index}_modalidadde"] = $company->modalidadde;
                }

                $companyData = [];
                for ($i = 1; $i <= 3; $i++) {
                    $companyData["company_company_name_{$i}"] = $companyColumns["company_{$i}_company_name"] ?? null;
                    $companyData["company_modalidadde_{$i}"] = $companyColumns["company_{$i}_modalidadde"] ?? null;
                }

                return [
                    $work->old_code,
                    optional($work->last_review)->format('d/m/Y'),
                    $work->revision,
                    $work->name,
                    $work->price,
                    $work->investment_standard,
                    $work->total_project_area,
                    $work->address,
                    $work->district,
                    $work->zip_code,
                    $work->city,
                    $work->state,
                    optional($work->started_at)->format('d/m/Y'),
                    optional($work->ends_at)->format('d/m/Y'),
                    $work->start_and_end,
                    optional($work->stage)->description,
                    optional($work->phase)->description,
                    optional($work->segment)->description,
                    optional($work->segmentSubType)->description,
                    $work->tower,
                    $work->house,
                    $work->condominium,
                    $work->floor,
                    $work->apartment_per_floor,
                    // conferido até aqui
                    
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
                    $work->air_conditioner,
                    $work->heating,
                    $work->foundry,
                    $work->frame,
                    $work->completion,
                    $work->facade,
                    $work->other_leisure,
                    // ... (outros campos da Obra)
                    // Adicione aqui os campos do contato usando $contactData
                    $contactData["contact_name_1"],
                    $contactData["contact_email_1"],
                    $contactData["contact_ddd_1"],
                    $contactData["contact_main_phone_1"],

                    $contactData["contact_name_2"],
                    $contactData["contact_email_2"],
                    $contactData["contact_ddd_2"],
                    $contactData["contact_main_phone_2"],

                    $contactData["contact_name_3"],
                    $contactData["contact_email_3"],
                    $contactData["contact_ddd_3"],
                    $contactData["contact_main_phone_3"],
                    
                    // ... (campos de contato restantes)
                    // Adicione aqui os campos da empresa usando $companyData
                    $companyData["company_company_name_1"],
                    $companyData["company_modalidadde_1"],
                    // ... (campos de empresa restantes)
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
            // conferido até aqui

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
            // 'Cobertura (m²)', // DOESN'T HAVE
            'Ar Condicionado',
            'Aquecimento',
            'Fundações',
            'Estrutura',
            'Acabamento',
            'Fachada',
            // 'Área de lazer', // HOW WE'LL MUST SHOW IT
            'Outros Lazer',
            // 'Detalhes', // WHAT'S IT?





            /* Contatos */
            'Nome do Contato 1',
            'Email do Contato 1',
            'DDD 1',
            'Telefone do Contato 1',
            'Nome do Contato 2',
            'Email do Contato 2',
            'DDD 2',
            'Telefone do Contato 2',
            'Nome do Contato 3',
            'Email do Contato 3',
            'DDD 3',
            'Telefone do Contato 3',
            /* Empresas participantes */
            'Nome Fantasia da Empresa Participante 1',
            'Modalidade 1',
            'Nome Fantasia da Empresa Participante 2',
            'Modalidade 2',
            'Nome Fantasia da Empresa Participante 3',
            'Modalidade 3',
        ];
    }
}
