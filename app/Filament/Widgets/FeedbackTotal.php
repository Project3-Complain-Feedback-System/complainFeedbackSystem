<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FeedbackTotal extends BaseWidget
{
    protected function getStats(): array
    {
        $positif = Feedback::where('rating', '>', 3, 'and')->count();
        $negatif = Feedback::where('rating', '<', 3, 'and')->count();
        $netral = Feedback::where('rating', '=', 3, 'and')->count();
        return [
            Stat::make('Feedback positif', "$positif orang")
                ->description("Sebanyak {$positif} orang memberikan komentar positif")
                // ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Komplain', "$negatif orang")
                ->description("Sebanyak {$negatif} orang mengirimkan komplain")
                // ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make('Feedback netral', "$netral orang")
                ->description("Sebanyak {$netral} orang memilih untuk memberikan respons netral")
            // ->chart([7, 2, 10, 3, 15, 4, 17])
        ];
    }
}
