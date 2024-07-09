<?php
// database/factories/NewsFactory.php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            // Ajoutez d'autres champs selon vos besoins
        ];
    }
}
