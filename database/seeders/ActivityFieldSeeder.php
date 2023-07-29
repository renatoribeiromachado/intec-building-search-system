<?php

namespace Database\Seeders;

use App\Models\ActivityField;
use Illuminate\Database\Seeder;

class ActivityFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activityFields = [
            ['description' => 'GRUPO EMPREENDEDOR'],
            ['description' => 'CONSTRUÇÃO CIVIL'],
            ['description' => 'AUTOMAÇÃO INDUSTRIAL'],
            ['description' => 'ARQUITETURA'],
            ['description' => 'INCORPORADORA'],
            ['description' => 'ADMINISTRADORA'],
            ['description' => 'INSTALAÇÃO ELÉTRICA'],
            ['description' => 'INSTALAÇÃO HIDRÁULICA'],
            ['description' => 'GERENCIAMENTO'],
            ['description' => 'PAISAGISMO'],
            ['description' => 'DECORAÇÃO'],
            ['description' => 'INSTALAÇÕES'],
            ['description' => 'DESIGN DE INTERIORES'],
            ['description' => 'PROJETISTA'],
            ['description' => 'CONCRETO USINADO'],
            ['description' => 'TERRAPLENAGEM'],
            ['description' => 'PLANEJAMENTO'],
            ['description' => 'EMPREITEIRA'],
            // new activity fields
            ['description' => 'SERVIÇOS PÚBLICOS'],
            ['description' => 'SERVIÇOS'],
            ['description' => 'HIPERMERCADOS/ SUPERMERCADOS'],
            ['description' => 'SHOPPING CENTERS/ OUTLET'],
            ['description' => 'COMUNITÁRIAS'],
            ['description' => 'CONSTRUTORAS'],
            ['description' => 'COOPERATIVAS/ SINDICATOS'],
            ['description' => 'INDÚSTRIA DE CONSUMO'],
            ['description' => 'AGRO-INDUSTRIAS'],
            ['description' => 'INDÚSTRIA DE ALIMENTOS'],
            ['description' => 'INDÚSTRIA MECÂNICA E ELÉTRICA'],
            ['description' => 'INDÚSTRIA DE MATERIAIS DE CONSTRUÇÃO'],
            ['description' => 'ENERGIA E TELECOMUNICAÇÕES'],
            ['description' => 'INDÚSTRIA DE FERROSOS E NÃO FERROSOS'],
            ['description' => 'INDÚSTRIA DE PETRÓLEO E AFINS'],
            ['description' => 'INDÚSTRIA DE BEBIDAS'],
            ['description' => 'COMÉRCIO EM GERAL'],
            ['description' => 'TURISMO'],
            ['description' => 'SAÚDE'],
            ['description' => 'SANEAMENTO BÁSICO/ SISTEMAS ANTI-POLUIÇÃO'],
            ['description' => 'VIDROS'],
            ['description' => 'INSTALAÇÃO ELÉTRICA E HIDRÁULICA'],
            ['description' => 'ESCRITÓRIO DE ARQUITETURA'],
            ['description' => 'ESCRITÓRIO DE ENGENHARIA'],
            ['description' => 'PRÉ-MOLDADO'],
            ['description' => 'IMOBILIÁRIA'],
        ];

        $activityFieldsQuantity = count($activityFields);
        ActivityField::factory($activityFieldsQuantity)
            ->make()
            ->each(function ($activityField, $key) use ($activityFields) {
                $activityFieldDescription = $activityFields[$key]['description'];
                $activityField->description = $activityFieldDescription;
                $activityField->save();
            });
    }
}
