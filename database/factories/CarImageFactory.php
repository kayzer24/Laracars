<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarImage>
 */
class CarImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_path' => "https://im.qccdn.fr/node/actualite-toyota-yaris-hybride-2020-premieres-impressions-82255/thumbnail_800x480px-136078.jpg",
            'position' => function (array $attr) {
                return Car::find($attr['car_id'])->images->count() + 1;
            },
        ];
    }
}
