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
