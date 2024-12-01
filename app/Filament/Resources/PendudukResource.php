<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendudukResource\Pages;
use App\Filament\Resources\PendudukResource\RelationManagers;
use App\Models\Penduduk;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendudukResource extends Resource
{
    protected static ?string $model = Penduduk::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';

    protected static ?string $navigationLabel = 'Penduduk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik')
                    ->required()
                    ->numeric()
                    ->maxLength(16),
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tanggal_lahir')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options([
                        'male' => 'Laki - Laki',
                        'female' => 'Perempuan',
                    ]),
                TextInput::make('agama')
                    ->required()
                    ->maxLength(255),
                Select::make('pendidikan')
                    ->options([
                        'SD' => 'SD',
                        'SMP' => 'SMP',
                        'SMA' => 'SMA',
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ])
                    ->required(),
                TextInput::make('pekerjaan')
                    ->required()
                    ->maxLength(255),
                Select::make('status_perkawinan')
                    ->options([
                        'kawin' => 'Kawin',
                        'belum' => 'Belum Kawin',
                    ]),
                Select::make('status_dalam_keluarga')
                    ->options([
                        'kepala_keluarga' => 'Kepala Keluarga',
                        'istri' => 'Istri',
                        'anak' => 'Anak',
                    ]),
                TextInput::make('kewarganegaraan')
                    ->required()
                    ->default('Indonesia')
                    ->maxLength(255),
                TextInput::make('nama_ayah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('nama_ibu')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nik')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('tempat_lahir')
                    ->searchable(),
                TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->sortable(),
                TextColumn::make('jenis_kelamin')
                    ->formatStateUsing(fn(string $state): string => $state == 'male' ? 'Laki - Laki' : 'Perempuan')
                    ->searchable(),
                TextColumn::make('agama')
                    ->searchable(),
                TextColumn::make('pendidikan')
                    ->searchable(),
                TextColumn::make('pekerjaan')
                    ->searchable(),
                TextColumn::make('status_perkawinan')
                    ->formatStateUsing(fn(string $state): string => $state == 'kawin' ? 'Kawin' : 'Belum Kawin')
                    ->searchable(),
                TextColumn::make('status_dalam_keluarga')
                    ->searchable(),
                TextColumn::make('kewarganegaraan')
                    ->searchable(),
                TextColumn::make('nama_ayah')
                    ->searchable(),
                TextColumn::make('nama_ibu')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPenduduks::route('/'),
            'create' => Pages\CreatePenduduk::route('/create'),
            'edit' => Pages\EditPenduduk::route('/{record}/edit'),
        ];
    }
}
