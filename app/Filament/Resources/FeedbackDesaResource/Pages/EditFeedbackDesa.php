<?php

namespace App\Filament\Resources\FeedbackDesaResource\Pages;

use App\Filament\Resources\FeedbackDesaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeedbackDesa extends EditRecord
{
    protected static string $resource = FeedbackDesaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
