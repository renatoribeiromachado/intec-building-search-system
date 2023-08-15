<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phases = [
            ['description' => 'Fase 1'],
            ['description' => 'Fase 2'],
            ['description' => 'Fase 3'],
        ];

        $phasesQuantity = count($phases);
        Phase::factory($phasesQuantity)
            ->make()
            ->each(function ($phase, $key) use ($phases) {
                $phaseDescription = $phases[$key]['description'];
                $phase->description = $phaseDescription;
                $phase->save();
            });
    }
}
