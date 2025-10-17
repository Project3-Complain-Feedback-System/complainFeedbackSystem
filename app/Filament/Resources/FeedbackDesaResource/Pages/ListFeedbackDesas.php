<?php

namespace App\Filament\Resources\FeedbackDesaResource\Pages;

use App\Filament\Resources\FeedbackDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedbackDesas extends ListRecords
{
    protected static string $resource = FeedbackDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
