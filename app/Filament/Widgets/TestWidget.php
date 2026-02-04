<?php

namespace App\Filament\Widgets;

use App\Models\Artist;
use App\Models\Artwork;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Artists', Artist::count())
                ->description('Total number of artists')
                ->descriptionIcon('heroicon-o-paint-brush', IconPosition::Before)
                ->chart([1,3,5,10,20,45])
                ->color('primary'),
            Stat::make('Artworks', Artwork::count())
                ->description('Number of published artworks')
                ->descriptionIcon('heroicon-o-photo', IconPosition::Before)
                ->chart([5,10,15,25,50,100])
                ->color('info'),
                ];
        


    }
}
