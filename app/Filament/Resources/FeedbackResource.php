<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
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

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-c-chat-bubble-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form->schema([
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
            ->modifyQueryUsing(fn (Builder $query) =>
            $query->orderByRaw("CASE
                WHEN status = 'pending' THEN 0
                WHEN status = 'done' THEN 1
                ELSE 2
            END")
            ->orderBy('created_at', 'desc')
        )
            ->columns([

                TextColumn::make('kategori.nama')->searchable(),

                TextColumn::make('rating')
                    ->formatStateUsing(function (string $state): string {
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
                    })
                    ->sortable(),

                TextColumn::make('komentar')
                ->searchable()
                ->limit(20) // Memotong pada 20 karakter
                ->wrap(),   // Membungkus teks yang ditampilkan

                ImageColumn::make('gambar'),

                //KOLOM STATUS (PALING KANAN)
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->alignEnd()
                    ->color(fn ($state) =>
                        $state === 'pending' ? 'warning' : 'success'
                    )
                    ->formatStateUsing(fn ($state) =>
                        $state === 'pending'
                            ? 'Belum Selesai'
                            : 'Selesai'
                    )
                    ->sortable(),

            ])
            ->filters([

                Filter::make('Tipe')
                    ->form([
                        Select::make('tipe_respon')->options([
                            'positif' => 'Umpan balik',
                            'negatif' => 'Kritik / Komplain',
                            'netral'  => 'Netral',
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

                /*SelectFilter::make('penduduk_id')
                    ->relationship('penduduk', 'nama')
                    ->searchable()
                    ->label('Penduduk'), */

                /*SelectFilter::make('nik')
                    ->relationship('penduduk', 'nik')
                    ->searchable(),*/

                SelectFilter::make('rating')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->label('Rating'),
                    //FILTER STATUS (TAMBAHAN SAJA)
                    SelectFilter::make('status')
                        ->label('Status')
                        ->options([
                            'pending' => 'Belum Selesai',
                            'done'    => 'Selesai',
                        ]),



            ],layout: FiltersLayout::AboveContent)
            ->filtersFormColumns(2)
            ->actions([

                Tables\Actions\ViewAction::make(),

                //ACTION UBAH STATUS (HANYA STATUS)
                Tables\Actions\Action::make('ubahStatus')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-check-circle')
                    ->form([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Belum Selesai',
                                'done'    => 'Selesai',
                            ])
                            ->required(),
                    ])
                    ->action(function (Feedback $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                        ]);
                    }),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            ImageEntry::make('gambar')
                ->size(400)
                ->width(840)
                ->maxWidth('full')
                ->columnSpanFull()
                ->hidden(fn ($record) => blank($record->gambar)),

            TextEntry::make('kategori.nama'),

            TextEntry::make('rating')
                ->formatStateUsing(function (string $state): string {
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

            //STATUS DI DETAIL VIEW
            TextEntry::make('status')
                ->label('Status')
                ->badge()
                ->color(fn ($state) =>
                    $state === 'pending' ? 'warning' : 'success'
                )
                ->formatStateUsing(fn ($state) =>
                    $state === 'pending'
                        ? 'Belum Selesai'
                        : 'Selesai'
                ),

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
            'index'  => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit'   => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }
}
