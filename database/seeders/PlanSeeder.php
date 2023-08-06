<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            ['created_by' => 3, 'updated_by' => 3, 'description' => 'Semestral'],
            ['created_by' => 3, 'updated_by' => 3, 'description' => 'Anual'],
        ];

        $plansQuantity = count($plans);
        Plan::factory($plansQuantity)
            ->make()
            ->each(function ($plan, $key) use ($plans) {
                $plan->description = $plans[$key]['description'];
                $plan->created_by = $plans[$key]['created_by'];
                $plan->updated_by = $plans[$key]['updated_by'];
                $plan->save();
            });
    }
}
