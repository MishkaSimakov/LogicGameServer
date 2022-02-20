<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    static protected int $order = 0;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'visible_tests_count' => $this->faker->numberBetween(1, 100),
            'order' => LevelFactory::$order++
        ];
    }
}
