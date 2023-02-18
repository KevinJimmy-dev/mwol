<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhraseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'word_id' => 1,
            'phrase' => $this->faker->sentence, 
            'phrase' => $this->faker->sentence, 
        ];
    }
}
