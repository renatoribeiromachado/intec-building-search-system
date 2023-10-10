<?php

namespace App\Exports;
use App\Models\Associate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AssociatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles {
    

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
    public function returnOrders($data)
    {
        $sql = "SELECT o.old_code,o.final_price
                FROM orders o
                WHERE o.company_id = $data
                ORDER BY o.created_at DESC
                LIMIT 1";

        $result = \DB::select($sql); // Usar selectOne para obter apenas um resultado
        
        return $result;

    }
    
    /**
     * @return \Illuminate\Support\Collection
     */
    public function returnContacts($data) {

        $sql = "SELECT
                    ct.email, 
                    MAX(ct.name) as name,
                    MAX(ct.secondary_email) as secondary_email,
                    MAX(ct.tertiary_email) as tertiary_email,
                    MAX(ct.ddd) as ddd,
                    MAX(ct.main_phone) as main_phone,
                    MAX(ct.ddd_two) as ddd_two,
                    MAX(ct.phone_two) as phone_two,
                    MAX(ct.ddd_three) as ddd_three,
                    MAX(ct.phone_three) as phone_three,
                    MAX(ct.ddd_four) as ddd_four,
                    MAX(ct.phone_four) as phone_four,
                    MAX(p.description) as position
                    FROM companies c 
                    JOIN contacts ct ON ct.company_id = c.id
                    JOIN positions p ON p.id = ct.position_id
                    WHERE ct.company_id = $data
                    GROUP BY ct.email
                ";
        
        $results = \DB::select($sql);

        return $results;
    } 
    
    public function collection() {
        
        return Associate::with(['company','segmentSubTypes'])
                    ->orderBy('old_code', 'asc')
                    ->get()
                    ->map(function ($associate) {
                        $contacts = $this->returnContacts($associate->company_id);
                        $orders = $this->returnOrders($associate->company_id); // Alteração aqui

                        $orderColumns = [];
                        $index = 0;
                        foreach ($orders as $order) {
                            $index++;
                            $orderColumns["order_{$index}_old_code"] = $order->old_code;
                            $orderColumns["order_{$index}_final_price"] = $order->final_price;
       
                        }

                        $orderData = [];
                        for ($i = 1; $i <= 10; $i++) {
                            $orderData["order_old_code_{$i}"] = $orderColumns["order_{$i}_old_code"] ?? null;
                            $orderData["order_final_price_{$i}"] = $orderColumns["order_{$i}_final_price"] ?? null;
                        }

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
                        }

                        $isActive = ($associate->company->is_active == 1) ? "Ativo" : "Inativo";
                        $dataFilterStartsAt = date('d/m/Y', strtotime($associate->data_filter_starts_at));
                        $dataFilterEndsAt = date('d/m/Y', strtotime($associate->data_filter_ends_at));
                        $contract = date('d/m/Y', strtotime($associate->contract_due_date_start));
                        $orderFinalPrice = $orderData["order_final_price_1"]; // Supondo que essa variável contenha o valor
                        $formattedPrice = number_format($orderFinalPrice, 2, ',', '.');
                        
                        return [
                            $associate->old_code,
                            
                            $orderData["order_old_code_1"],
                            $formattedPrice,
                            
                            $associate->company->company_name,
                            $associate->company->trading_name,
                            $associate->company->address . ', ' .
                            $associate->company->number . ' - ' .
                            $associate->company->district . ' - ' .
                            $associate->company->city . ' - ' .
                            $associate->company->state,
                            $associate->company->zip_code,
                            $associate->company->phone_one,
                            $associate->company->primary_email,
                            $associate->company->secondary_email,
                            $associate->company->home_page,
             
                            
                            $associate->company->cnpj,
                            $associate->company->state_registration,
                            $contract,
                            $associate->business_branch,
                            $associate->company->activityField->description,
                            $dataFilterStartsAt,
                            $dataFilterEndsAt,
                            $associate->products_and_services,
                            $associate->company->notes,
                            $associate->company_date_birth,
                            $associate->salesperson->name,
                            $associate->company->classification,
                            $associate->company->reason,
                            $isActive,
                            
                             // Adicione os dados de contato usando o array contactData
                            $contactData["contact_name_1"],
                            $contactData["contact_position_1"],
                            implode(' / ', array_filter([$contactData["contact_email_1"], $contactData["contact_secondary_email_1"], $contactData["contact_tertiary_email_1"]])),
                          
                            (!empty($contactData["contact_ddd_1"]) && !empty($contactData["contact_main_phone_1"]) ? '(' . $contactData["contact_ddd_1"] . ')' . $contactData["contact_main_phone_1"] : '') .
                            (!empty($contactData["contact_ddd_two_1"]) && !empty($contactData["contact_phone_two_1"]) ? ' / (' . $contactData["contact_ddd_two_1"] . ')' . $contactData["contact_phone_two_1"] : '') .
                            (!empty($contactData["contact_ddd_three_1"]) && !empty($contactData["contact_phone_three_1"]) ? ' / (' . $contactData["contact_ddd_three_1"] . ')' . $contactData["contact_phone_three_1"] : '') .
                            (!empty($contactData["contact_ddd_four_1"]) && !empty($contactData["contact_phone_four_1"]) ? ' / (' . $contactData["contact_ddd_four_1"] . ')' . $contactData["contact_phone_four_1"] : ''),

                            $contactData["contact_name_2"],
                            $contactData["contact_position_2"],
                            implode(' / ', array_filter([$contactData["contact_email_2"], $contactData["contact_secondary_email_2"], $contactData["contact_tertiary_email_2"]])),
                            
                            (!empty($contactData["contact_ddd_2"]) && !empty($contactData["contact_main_phone_2"]) ? '(' . $contactData["contact_ddd_2"] . ')' . $contactData["contact_main_phone_2"] : '') .
                            (!empty($contactData["contact_ddd_two_2"]) && !empty($contactData["contact_phone_two_2"]) ? ' / (' . $contactData["contact_ddd_two_2"] . ')' . $contactData["contact_phone_two_2"] : '') .
                            (!empty($contactData["contact_ddd_three_2"]) && !empty($contactData["contact_phone_three_2"]) ? ' / (' . $contactData["contact_ddd_three_2"] . ')' . $contactData["contact_phone_three_2"] : '') .
                            (!empty($contactData["contact_ddd_four_2"]) && !empty($contactData["contact_phone_four_2"]) ? ' / (' . $contactData["contact_ddd_four_2"] . ')' . $contactData["contact_phone_four_2"] : ''),
             
                            $contactData["contact_name_3"],
                            $contactData["contact_position_3"],
                            implode(' / ', array_filter([$contactData["contact_email_3"], $contactData["contact_secondary_email_3"], $contactData["contact_tertiary_email_3"]])),
                            
                            (!empty($contactData["contact_ddd_3"]) && !empty($contactData["contact_main_phone_3"]) ? '(' . $contactData["contact_ddd_3"] . ')' . $contactData["contact_main_phone_3"] : '') .
                            (!empty($contactData["contact_ddd_two_3"]) && !empty($contactData["contact_phone_two_3"]) ? ' / (' . $contactData["contact_ddd_two_3"] . ')' . $contactData["contact_phone_two_3"] : '') .
                            (!empty($contactData["contact_ddd_three_3"]) && !empty($contactData["contact_phone_three_3"]) ? ' / (' . $contactData["contact_ddd_three_3"] . ')' . $contactData["contact_phone_three_3"] : '') .
                            (!empty($contactData["contact_ddd_four_3"]) && !empty($contactData["contact_phone_four_3"]) ? ' / (' . $contactData["contact_ddd_four_3"] . ')' . $contactData["contact_phone_four_3"] : ''),

                            $contactData["contact_name_4"],
                            $contactData["contact_position_4"],
                            implode(' / ', array_filter([$contactData["contact_email_4"], $contactData["contact_secondary_email_4"], $contactData["contact_tertiary_email_4"]])),
                            
                            (!empty($contactData["contact_ddd_4"]) && !empty($contactData["contact_main_phone_4"]) ? '(' . $contactData["contact_ddd_4"] . ')' . $contactData["contact_main_phone_4"] : '') .
                            (!empty($contactData["contact_ddd_two_4"]) && !empty($contactData["contact_phone_two_4"]) ? ' / (' . $contactData["contact_ddd_two_4"] . ')' . $contactData["contact_phone_two_4"] : '') .
                            (!empty($contactData["contact_ddd_three_4"]) && !empty($contactData["contact_phone_three_4"]) ? ' / (' . $contactData["contact_ddd_three_4"] . ')' . $contactData["contact_phone_three_4"] : '') .
                            (!empty($contactData["contact_ddd_four_4"]) && !empty($contactData["contact_phone_four_4"]) ? ' / (' . $contactData["contact_ddd_four_4"] . ')' . $contactData["contact_phone_four_4"] : ''),

                            $contactData["contact_name_5"],
                            $contactData["contact_position_5"],
                            implode(' / ', array_filter([$contactData["contact_email_5"], $contactData["contact_secondary_email_5"], $contactData["contact_tertiary_email_5"]])),
                            
                            (!empty($contactData["contact_ddd_5"]) && !empty($contactData["contact_main_phone_5"]) ? '(' . $contactData["contact_ddd_5"] . ')' . $contactData["contact_main_phone_5"] : '') .
                            (!empty($contactData["contact_ddd_two_5"]) && !empty($contactData["contact_phone_two_5"]) ? ' / (' . $contactData["contact_ddd_two_5"] . ')' . $contactData["contact_phone_two_5"] : '') .
                            (!empty($contactData["contact_ddd_three_5"]) && !empty($contactData["contact_phone_three_5"]) ? ' / (' . $contactData["contact_ddd_three_5"] . ')' . $contactData["contact_phone_three_5"] : '') .
                            (!empty($contactData["contact_ddd_four_5"]) && !empty($contactData["contact_phone_four_5"]) ? ' / (' . $contactData["contact_ddd_four_5"] . ')' . $contactData["contact_phone_four_5"] : ''),
                            
                            $contactData["contact_name_6"],
                            $contactData["contact_position_6"],
                            implode(' / ', array_filter([$contactData["contact_email_6"], $contactData["contact_secondary_email_6"], $contactData["contact_tertiary_email_6"]])),
                            
                            (!empty($contactData["contact_ddd_6"]) && !empty($contactData["contact_main_phone_6"]) ? '(' . $contactData["contact_ddd_6"] . ')' . $contactData["contact_main_phone_6"] : '') .
                            (!empty($contactData["contact_ddd_two_6"]) && !empty($contactData["contact_phone_two_6"]) ? ' / (' . $contactData["contact_ddd_two_6"] . ')' . $contactData["contact_phone_two_6"] : '') .
                            (!empty($contactData["contact_ddd_three_6"]) && !empty($contactData["contact_phone_three_6"]) ? ' / (' . $contactData["contact_ddd_three_6"] . ')' . $contactData["contact_phone_three_6"] : '') .
                            (!empty($contactData["contact_ddd_four_6"]) && !empty($contactData["contact_phone_four_6"]) ? ' / (' . $contactData["contact_ddd_four_6"] . ')' . $contactData["contact_phone_four_6"] : ''),

                            $contactData["contact_name_7"],
                            $contactData["contact_position_7"],
                            implode(' / ', array_filter([$contactData["contact_email_7"], $contactData["contact_secondary_email_7"], $contactData["contact_tertiary_email_7"]])),
                         
                            (!empty($contactData["contact_ddd_7"]) && !empty($contactData["contact_main_phone_7"]) ? '(' . $contactData["contact_ddd_7"] . ')' . $contactData["contact_main_phone_7"] : '') .
                            (!empty($contactData["contact_ddd_two_7"]) && !empty($contactData["contact_phone_two_7"]) ? ' / (' . $contactData["contact_ddd_two_7"] . ')' . $contactData["contact_phone_two_7"] : '') .
                            (!empty($contactData["contact_ddd_three_7"]) && !empty($contactData["contact_phone_three_7"]) ? ' / (' . $contactData["contact_ddd_three_7"] . ')' . $contactData["contact_phone_three_7"] : '') .
                            (!empty($contactData["contact_ddd_four_7"]) && !empty($contactData["contact_phone_four_7"]) ? ' / (' . $contactData["contact_ddd_four_7"] . ')' . $contactData["contact_phone_four_7"] : ''),
            
                            $contactData["contact_name_8"],
                            $contactData["contact_position_8"],
                            implode(' / ', array_filter([$contactData["contact_email_8"], $contactData["contact_secondary_email_8"], $contactData["contact_tertiary_email_8"]])),
                            
                            (!empty($contactData["contact_ddd_8"]) && !empty($contactData["contact_main_phone_8"]) ? '(' . $contactData["contact_ddd_8"] . ')' . $contactData["contact_main_phone_8"] : '') .
                            (!empty($contactData["contact_ddd_two_8"]) && !empty($contactData["contact_phone_two_8"]) ? ' / (' . $contactData["contact_ddd_two_8"] . ')' . $contactData["contact_phone_two_8"] : '') .
                            (!empty($contactData["contact_ddd_three_8"]) && !empty($contactData["contact_phone_three_8"]) ? ' / (' . $contactData["contact_ddd_three_8"] . ')' . $contactData["contact_phone_three_8"] : '') .
                            (!empty($contactData["contact_ddd_four_8"]) && !empty($contactData["contact_phone_four_8"]) ? ' / (' . $contactData["contact_ddd_four_8"] . ')' . $contactData["contact_phone_four_8"] : ''),
                            
                            $contactData["contact_name_9"],
                            $contactData["contact_position_9"],
                            implode(' / ', array_filter([$contactData["contact_email_9"], $contactData["contact_secondary_email_9"], $contactData["contact_tertiary_email_9"]])),

                            (!empty($contactData["contact_ddd_9"]) && !empty($contactData["contact_main_phone_9"]) ? '(' . $contactData["contact_ddd_9"] . ')' . $contactData["contact_main_phone_9"] : '') .
                            (!empty($contactData["contact_ddd_two_9"]) && !empty($contactData["contact_phone_two_9"]) ? ' / (' . $contactData["contact_ddd_two_9"] . ')' . $contactData["contact_phone_two_9"] : '') .
                            (!empty($contactData["contact_ddd_three_9"]) && !empty($contactData["contact_phone_three_9"]) ? ' / (' . $contactData["contact_ddd_three_9"] . ')' . $contactData["contact_phone_three_9"] : '') .
                            (!empty($contactData["contact_ddd_four_9"]) && !empty($contactData["contact_phone_four_9"]) ? ' / (' . $contactData["contact_ddd_four_9"] . ')' . $contactData["contact_phone_four_9"] : ''),
    
                            $contactData["contact_name_10"],
                            $contactData["contact_position_10"],
                            implode(' / ', array_filter([$contactData["contact_email_10"], $contactData["contact_secondary_email_10"], $contactData["contact_tertiary_email_10"]])),

                            (!empty($contactData["contact_ddd_10"]) && !empty($contactData["contact_main_phone_10"]) ? '(' . $contactData["contact_ddd_10"] . ')' . $contactData["contact_main_phone_10"] : '') .
                            (!empty($contactData["contact_ddd_two_10"]) && !empty($contactData["contact_phone_two_10"]) ? ' / (' . $contactData["contact_ddd_two_10"] . ')' . $contactData["contact_phone_two_10"] : '') .
                            (!empty($contactData["contact_ddd_three_10"]) && !empty($contactData["contact_phone_three_10"]) ? ' / (' . $contactData["contact_ddd_three_10"] . ')' . $contactData["contact_phone_three_10"] : '') .
                            (!empty($contactData["contact_ddd_four_10"]) && !empty($contactData["contact_phone_four_10"]) ? ' / (' . $contactData["contact_ddd_four_10"] . ')' . $contactData["contact_phone_four_10"] : ''),
          
                        ];
            });
    }

    public function headings(): array {
        return [
            /* Dados do Associado*/
            'Codigo',
            'Nº Pedido(s)',
            'Valor',
            'Razão Social',
            'Fantasia',
            'Endereço',
            'CEP',
            'Telefone',
            'E-mail 1',
            'E-mail 2',
            'Site',
            
            'CNPJ',
            'Inscrição Estadual',
            'Emissão',
            'Ramo',
            'Atividade',
            'Início',
            'Término',
            'Produtos e Serviços',
            'Observações',
            'Aniversário do Associado',
            'Vendedor',
            
            'Classificação',
            'Motivo',
            'Status',

            'Nome do Contato 1',
            'Cargo 1',
            'Email do Contato 1',
            'Telefone do Contato 1',

            'Nome do Contato 2',
            'Cargo 2',
            'Email do Contato 2',
            'Telefone do Contato 2',
 
            'Nome do Contato 3',
            'Cargo 3',
            'Email do Contato 3',
            'Telefone do Contato 3',
    
           
            'Nome do Contato 4',
            'Cargo 4',
            'Email do Contato 4',
            'Telefone do Contato 4',
            
            'Nome do Contato 5',
            'Cargo 5',
            'Email do Contato 5',
            'Telefone do Contato 5',
            
            'Nome do Contato 6',
            'Cargo 6',
            'Email do Contato 6',
            'Telefone do Contato 6',
            
            'Nome do Contato 7',
            'Cargo 7',
            'Email do Contato 7',
            'Telefone do Contato 7',
            
            'Nome do Contato 8',
            'Cargo 8',
            'Email do Contato 8',
            'Telefone do Contato 8',
            
            'Nome do Contato 9',
            'Cargo 9',
            'Email do Contato 9',
            'Telefone do Contato 9',
            
            'Nome do Contato 10',
            'Cargo 10',
            'Email do Contato 10',
            'Telefone do Contato 10',

        ];
    }

}
