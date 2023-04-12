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
        $startDate = $this->faker->date();
        $endDate = $this->faker->date('Y-m-d', $startDate);

        return [
            'start' => $startDate,
            'end' => $endDate,
            'price' => $this->faker->randomFloat(4, 1, 10000)
        ];
    }
}
