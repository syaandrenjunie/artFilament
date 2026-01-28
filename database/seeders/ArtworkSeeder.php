<?php

namespace Database\Seeders;

use App\Models\Artwork;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        Artwork::factory()
            ->count(20)
            ->create()
            ->each(function ($artwork) {
                $artwork
                    ->addMediaFromUrl('https://picsum.photos/600/600')
                    ->toMediaCollection('art_picture', 'local');
            });
    }
}

