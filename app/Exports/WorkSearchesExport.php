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
    const DATE_FORMAT = 'd/m/Y';
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
                // $companies = $this->returnCompanies($work->id);
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

                return [
                    $work->old_code, // Código
                    optional($work->last_review)->format(self::DATE_FORMAT), // Data da última atualização
                    $work->revision, // Nº de revisão
                    $work->name, // Nome da Obra
                    $work->price, // Valor do Investimento R$
                    $work->investment_standard, // Padrão de investimento
                    $work->total_project_area, // Área Total do Projeto
                    $work->address, // Endereço
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

                    // ... (campos de contato restantes)
                    // Adicione aqui os campos da empresa usando $companyData
                    $companyData["company_company_name_1"],
                    $companyData["company_activity_field_1"], // Modalidade / Atividade
                    $companyData["company_cnpj_1"],

                    $companyData["company_company_name_2"],
                    $companyData["company_activity_field_2"], // Modalidade / Atividade
                    $companyData["company_cnpj_2"],

                    $companyData["company_company_name_3"],
                    $companyData["company_activity_field_3"], // Modalidade / Atividade
                    $companyData["company_cnpj_3"],
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
            'Ar Condicionado',
            'Aquecimento',
            'Fundações',
            'Estrutura',
            'Acabamento',
            'Fachada',
            // 'Área de lazer', // HOW WE'LL MUST SHOW IT
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
