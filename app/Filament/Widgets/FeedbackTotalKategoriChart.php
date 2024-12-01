<?php

namespace App\Filament\Widgets;

use App\Models\Feedback;
use Filament\Widgets\ChartWidget;

class FeedbackTotalKategoriChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah respon penduduk: Berdasarkan kategori';

    protected function getData(): array
    {
        $feedbackByCategory = Feedback::with('kategori')
            ->selectRaw('kategori_id, COUNT(*) as total_komentar')
            ->groupBy('kategori_id')
            ->get();

        $categories = $feedbackByCategory->map(fn($feedback) => $feedback->kategori->nama)->toArray();
        $totalKomentar = $feedbackByCategory->pluck('total_komentar')->toArray();

        $colors = array_map(fn() => sprintf('rgb(%d, %d, %d)', rand(0, 255), rand(0, 255), rand(0, 255)), $categories);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Komentar',
                    'data' => $totalKomentar,
                    'backgroundColor' => $colors,
                    'borderColor' => '#000',
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $categories,
        ];
    }





    protected function getType(): string
    {
        return 'bar';
    }
}
