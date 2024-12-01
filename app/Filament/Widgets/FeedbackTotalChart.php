<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;

class FeedbackTotalChart extends ChartWidget
{
    protected static ?string $heading = 'Respon Penduduk: Positif, Negatif, Netral';

    protected function getData(): array
    {
        $positif = Feedback::where('rating', '>', 3)->count();
        $negatif = Feedback::where('rating', '<', 3)->count();
        $netral = Feedback::where('rating', '=', 3)->count();
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Feedback',
                    'data' => [$positif, $negatif, $netral],
                    "backgroundColor" => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)'
                    ],
                    'borderColor' => '#000',
                ],
            ],
            'labels' => ['Positif', 'Negatif', 'Netral'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
