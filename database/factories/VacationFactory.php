<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VacationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $endDate = $this->faker->date();
        $startDate = $this->faker->date('Y-m-d', $endDate);

        return [
            'start' => $startDate,
            'end' => $endDate,
            'price' => $this->faker->randomFloat(4, 1, 10000)
        ];
    }
}
