<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News; // Assurez-vous que le modèle News est correctement référencé ici

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::factory()->count(20)->create();
    }
}


