<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
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
        
        $name = fake()->name();

        return [
            'name' => $name,
            'bio' => fake()->sentence(),
            'email' => Str::slug($name, '.') . '@' . fake()->freeEmailDomain(),
            'contact' => fake()->phoneNumber(),
            'picture' => $faker->imageUrl(150,150)



        ];
}
}
