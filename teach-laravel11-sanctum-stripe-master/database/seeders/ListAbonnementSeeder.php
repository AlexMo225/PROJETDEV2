<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ListabonnementSeeder extends Seeder
{
    public function run()
    {
        DB::table('listabonnement')->insert([
            [
                'name' => 'Basic Plan',
                'price' => 30.00,
                'description' => '2 réservations par mois. Accès aux terrains de base. Chasuble dispo.',
                'image' => '/img/yg.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pro Plan',
                'price' => 60.00,
                'description' => '10 réservations par mois. Notification de disponibilité. Intégration calendrier.',
                'image' => '/img/stadium.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Premium Plan',
                'price' => 90.00,
                'description' => 'Réservations illimitées. Terrains premium. Gestion des événements.',
                'image' => '/img/foot.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
