<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stages = [
            ['phase_id' => 1, 'description' => 'CONTENÇÃO'],
            ['phase_id' => 1, 'description' => 'FUNDAÇÕES'],
            ['phase_id' => 1, 'description' => 'SERVIÇOS PRELIMINARES'],
            ['phase_id' => 1, 'description' => 'DEMOLIÇÃO'],
            ['phase_id' => 1, 'description' => 'LANÇAMENTO'],
            ['phase_id' => 1, 'description' => 'SONDAGEM'],
            ['phase_id' => 1, 'description' => 'ESTUDO DE VIABILIDADE'],
            ['phase_id' => 1, 'description' => 'PROJETO'],
            ['phase_id' => 1, 'description' => 'TERRAPLENAGEM'],

            ['phase_id' => 2, 'description' => 'ACABAMENTO'],
            ['phase_id' => 2, 'description' => 'EM CONSTRUÇÃO'],
            ['phase_id' => 2, 'description' => 'RESTAURAÇÃO'],
            ['phase_id' => 2, 'description' => 'ALVENARIA'],
            ['phase_id' => 2, 'description' => 'ESTRUTURA'],
            ['phase_id' => 2, 'description' => 'REVESTIMENTO'],
            ['phase_id' => 2, 'description' => 'COBERTURA'],
            ['phase_id' => 2, 'description' => 'REFORMA'],

            ['phase_id' => 3, 'description' => 'CANCELADA'],
            ['phase_id' => 3, 'description' => 'CONCLUÍDA'],
            ['phase_id' => 3, 'description' => 'PARADA TEMPORARIAMENTE'],
        ];

        $rolesQuantity = count($stages);
        Stage::factory($rolesQuantity)
            ->make()
            ->each(function ($stage, $key) use ($stages) {
                $stageDescription = $stages[$key]['description'];
                $phaseId = $stages[$key]['phase_id'];
                
                $stage->phase_id = $phaseId;
                $stage->description = $stageDescription;
                $stage->save();
            });
    }
}
