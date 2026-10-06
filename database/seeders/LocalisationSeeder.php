<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Localisation;

class LocalisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Localisation::create(["ville" => "Les Clayes-sous-bois"]);
        Localisation::create(["ville" => "Villepreux"]);
        Localisation::create(["ville" => "Plaisir"]);
        Localisation::create(["ville" => "Saint-Quentin-en-yvelines"]);
    }
}
