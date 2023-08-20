<?php

namespace Database\Factories;

use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $state = State::get()->random();
        
        return [
            'state_id' => $state->id,
            'description' => $this->faker->text(100)
        ];
    }
}
