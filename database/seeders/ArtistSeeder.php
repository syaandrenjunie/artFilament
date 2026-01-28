<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artist::factory()
            ->count(10)
            ->create()
            ->each(function ($artist) {
                $artist
                    ->addMediaFromUrl('https://picsum.photos/300/300')
                    ->toMediaCollection('profile_picture', 'local');
            });
    }
}
