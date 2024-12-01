<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use App\Models\Kategori;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-c-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }
    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penduduk.nama')
                    ->description(function (Feedback $record) {
                        return $record->penduduk->nik;
                    })
                    ->searchable()
                    ->label('Nama penduduk'),
                TextColumn::make('kategori.nama'),
                TextColumn::make('rating')->formatStateUsing(function (string $state): string {
                    if ($state == 1) {
                        return '⭐️';
                    } elseif ($state == 2) {
                        return '⭐️⭐️';
                    } elseif ($state == 3) {
                        return '⭐️⭐️⭐️';
                    } elseif ($state == 4) {
                        return '⭐️⭐️⭐️⭐️';
                    } else {
                        return '⭐️⭐️⭐️⭐️⭐️';
                    }
                })->sortable(),
                TextColumn::make('komentar')->searchable(),
                ImageColumn::make('gambar'),
            ])
            ->filters([
                Filter::make('Tipe')
                    ->form([
                        Select::make('tipe_respon')->options([
                            'positif' => 'Umpan balik',
                            'negatif' => 'Kritik / Komplain',
                            'netral' => 'Netral',
                        ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if ($data['tipe_respon'] === 'positif') {
                            return $query->where('rating', '>', 3);
                        }
                        if ($data['tipe_respon'] === 'negatif') {
                            return $query->where('rating', '<', 3);
                        }
                        if ($data['tipe_respon'] === 'netral') {
                            return $query->where('rating', '=', 3);
                        }
                        return $query;
                    }),
                SelectFilter::make('kategori_id')
                    ->relationship('kategori', 'nama')
                    ->label('Kategori'),
                SelectFilter::make('penduduk_id')
                    ->relationship('penduduk', 'nama')
                    ->searchable()
                    ->label('Penduduk'),
                SelectFilter::make('nik')
                    ->relationship('penduduk', 'nik')
                    ->searchable(),
                SelectFilter::make('rating')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->label('Rating'),


            ], layout: FiltersLayout::AboveContent)->filtersFormColumns(2)
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('gambar')->size(400)->width(840)->maxWidth('full')->columnSpanFull(),
                TextEntry::make('penduduk.nama')->label('Nama penduduk'),
                TextEntry::make('kategori.nama'),
                TextEntry::make('rating')->formatStateUsing(function (string $state): string {
                    if ($state == 1) {
                        return '⭐️';
                    } elseif ($state == 2) {
                        return '⭐️⭐️';
                    } elseif ($state == 3) {
                        return '⭐️⭐️⭐️';
                    } elseif ($state == 4) {
                        return '⭐️⭐️⭐️⭐️';
                    } else {
                        return '⭐️⭐️⭐️⭐️⭐️';
                    }
                }),
                TextEntry::make('komentar'),
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
