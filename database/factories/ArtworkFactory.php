<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        return [
            'title' => fake()->sentence(3),
            'price' => fake()->randomFloat(2, 10, 500),
            'artist_id' => Artist::inRandomOrder()->first()->id ?? Artist::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'picture' => $faker->imageUrl(150, 150)
        ];
    }
}
