<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'language_id' => 1,
            'user_id' => 1,
            'name' => $this->faker->word,
            'translation' => $this->faker->word()
        ];
    }
}
