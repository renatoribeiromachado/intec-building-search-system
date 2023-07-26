<?php

namespace Database\Seeders;

use App\Models\WorkFeature;
use Illuminate\Database\Seeder;

class WorkFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            ['description' => 'Salão de festas'],
            ['description' => 'Churrasqueira'],
            ['description' => 'Playground'],
            ['description' => 'Salão de jogos'],
            ['description' => 'Quadra'],
            ['description' => 'Spa'],
            ['description' => 'Piscina'],
            ['description' => 'Fitness'],
            ['description' => 'Brinquedoteca'],
            ['description' => 'Sauna'],
            ['description' => 'Gourmet'],
        ];

        $featuresQuantity = count($features);
        WorkFeature::factory($featuresQuantity)
            ->make()
            ->each(function ($workFeature, $key) use ($features) {
                $workFeatureDescription = $features[$key]['description'];
                $workFeature->description = $workFeatureDescription;
                $workFeature->notes = null;
                $workFeature->save();
            });
    }
}
