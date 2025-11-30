<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Car Types with the following data using factories
        CarType::factory()
            ->sequence(
                ['name' => 'Sedan'],
                ['name' => 'Hatchback'],
                ['name' => 'SUV'],
                ['name' => 'Coupe'],
                ['name' => 'Crossover'],
                ['name' => 'Van'],
            )
            ->count(6)
            ->create();

        // Create Fuel Types with the following data using factories
        FuelType::factory()
            ->sequence(
                ['name' => 'Petrol'],
                ['name' => 'Diesel'],
                ['name' => 'Hybrid'],
                ['name' => 'Electric'],
            )
            ->count(4)
            ->create();

        // Create States with Cities
        $states = [
            'Auvergne-Rhône-Alpes' => ['Ain (01)', 'Allier (03)', 'Ardèche (07)', 'Cantal (15)', 'Drôme (26)', 'Isère (38)', 'Loire (42)', 'Haute-Loire (43)', 'Puy-de-Dôme (63)', 'Rhône (69)', 'Savoie (73)', 'Haute-Savoie (74)'],
            'Bourgogne-Franche-Comté' => ['Côte-d\'Or (21)', 'Doubs (25)', 'Jura (39)', 'Nièvre (58)', 'Haute-Saône (70)', 'Saône-et-Loire (71)', 'Yonne (89)', 'Territoire de Belfort (90)'],
            'Bretagne' => ['Côtes-d\'Armor (22)', 'Finistère (29)', 'Ille-et-Vilaine (35)', 'Morbihan (56)'],
            'Centre-Val de Loire' => ['Cher (18)', 'Eure-et-Loir (28)', 'Indre (36)', 'Indre-et-Loire (37)', 'Loir-et-Cher (41)', 'Loiret (45)'],
            'Corse' => ['Corse-du-Sud (2A)', 'Haute-Corse (2B)'],
            'Grand Est' => ['Ardennes (08)', 'Aube (10)', 'Marne (51)', 'Haute-Marne (52)', 'Meurthe-et-Moselle (54)', 'Meuse (55)', 'Moselle (57)', 'Bas-Rhin (67)', 'Haut-Rhin (68)', 'Vosges (88)'],
            'Hauts-de-France' => ['Aisne (02)', 'Nord (59)', 'Oise (60)', 'Pas-de-Calais (62)', 'Somme (80)'],
            'Île-de-France' => ['Paris (75)', 'Seine-et-Marne (77)', 'Yvelines (78)', 'Essonne (91)', 'Hauts-de-Seine (92)', 'Seine-Saint-Denis (93)', 'Val-de-Marne (94)', 'Val-d\'Oise (95)'],
            'Normandie' => ['Calvados (14)', 'Eure (27)', 'Manche (50)', 'Orne (61)', 'Seine-Maritime (76)'],
            'Nouvelle-Aquitaine' => ['Charente (16)', 'Charente-Maritime (17)', 'Corrèze (19)', 'Creuse (23)', 'Dordogne (24)', 'Gironde (33)', 'Landes (40)', 'Lot-et-Garonne (47)', 'Pyrénées-Atlantiques (64)', 'Deux-Sèvres (79)', 'Vienne (86)', 'Haute-Vienne (87)'],
            'Occitanie' => ['Ariège (09)', 'Aude (11)', 'Aveyron (12)', 'Gard (30)', 'Haute-Garonne (31)', 'Gers (32)', 'Hérault (34)', 'Lot (46)', 'Lozère (48)', 'Hautes-Pyrénées (65)', 'Pyrénées-Orientales (66)', 'Tarn (81)', 'Tarn-et-Garonne (82)'],
            'Pays de la Loire' => ['Loire-Atlantique (44)', 'Maine-et-Loire (49)', 'Mayenne (53)', 'Sarthe (72)', 'Vendée (85)'],
            'Provence-Alpes-Côte d\'Azur' => ['Alpes-de-Haute-Provence (04)', 'Hautes-Alpes (05)', 'Alpes-Maritimes (06)', 'Bouches-du-Rhône (13)', 'Var (83)', 'Vaucluse (84)'],

            // Outre-mer
            'Guadeloupe' => ['Guadeloupe (971)'],
            'Martinique' => ['Martinique (972)'],
            'Guyane' => ['Guyane (973)'],
            'La Réunion' => ['La Réunion (974)'],
            'Mayotte' => ['Mayotte (976)'],
        ];

        foreach ($states as $state => $cities) {
            State::factory()
                ->state(['name' => $state])
                ->has(
                    City::factory()
                        ->count(count($cities))
                        ->sequence(...array_map(fn ($city) => ['name' => $city], $cities))
                )
                ->create();
        }

        // Create makers with the corresponding models
        $makers = [
            'Toyota' => ['Yaris', 'Corolla', 'Camry', 'RAV4', 'Land Cruiser'],
            'BMW' => ['Serie 1', 'Serie 3', 'Serie 5', 'X3', 'X5'],
            'Mercedes' => ['Classe A', 'Classe C', 'Classe E', 'GLA', 'GLC'],
            'Volkswagen' => ['Golf', 'Polo', 'Passat', 'Tiguan', 'T-Roc'],
            'Peugeot' => ['208', '308', '3008', '5008', '508'],
        ];

        foreach ($makers as $maker => $models) {
            Maker::factory()
                ->state(['name' => $maker])
                ->has(
                    Model::factory()
                        ->count(count($models))
                        ->sequence(...array_map(fn ($model) => ['name' => $model], $models))
                )
                ->create();
        }

        // Create users, cars with images and features
        // Create 3 users first, then create 2 more users
        // And for each user (from the last 2 users) create 50 cars,
        // With images and features and add these cars to favorite cars
        // of these 2 users
        User::factory()
            ->count(3)
            ->create();

        User::factory()
            ->count(2)
            ->has(
                Car::factory()
                    ->count(50)
                    ->has(
                        CarImage::factory()
                            ->count(5)
                            ->sequence(fn (Sequence $sequence) => ['position' => $sequence->index % 5 + 1]),
                        'images'
                    )
                    ->hasFeatures(),
                'favouriteCars'
            )
            ->create();

        //        $this->call([
        //            UserSeeder::class,
        //        ]);
    }
}
