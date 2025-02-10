<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'ingredients' => json_encode($this->faker->words(5)),
            'image' => $this->faker->imageUrl,
            'instructions' => $this->faker->paragraph,
            'user_id' => 1, // Definindo user_id fixo como 1
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
