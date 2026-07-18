<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackDesaResource\Pages;
use App\Models\FeedbackDesa;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FeedbackDesaResource extends Resource
{
    protected static ?string $model = FeedbackDesa::class;

    protected static ?string $navigationIcon = 'heroicon-c-chat-bubble-left-ellipsis';

    protected static ?string $navigationLabel = 'Feedback Desa';

    protected static ?string $pluralLabel = 'Daftar Feedback Desa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('keterangan'),
                FileUpload::make('gambar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('keterangan')
                ->searchable()
                ->limit(50)// Memotong pada 50 karakter
                ->wrap(),// Membungkus teks yang ditampilkan
                ImageColumn::make('gambar')
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedbackDesas::route('/'),
            'create' => Pages\CreateFeedbackDesa::route('/create'),
            'edit' => Pages\EditFeedbackDesa::route('/{record}/edit'),
        ];
    }
}
