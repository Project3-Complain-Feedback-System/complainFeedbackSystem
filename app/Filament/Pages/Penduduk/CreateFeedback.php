<?php

namespace App\Filament\Pages;

use App\Models\Feedback;
use App\Models\Kategori;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Livewire\WithFileUploads;

class CreateFeedback extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-c-chat-bubble-left-ellipsis';

    protected static ?string $navigationLabel = 'Tambah Feedback Baru';

    protected static ?string $title = 'Tambah Feedback';

    protected static string $view = 'filament.pages.create-feedback';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(Kategori::pluck('nama', 'id'))
                    ->required(),

                Select::make('rating')
                    ->label('Rating')
                    ->options([
                        1 => '⭐',
                        2 => '⭐⭐',
                        3 => '⭐⭐⭐',
                        4 => '⭐⭐⭐⭐',
                        5 => '⭐⭐⭐⭐⭐',
                    ])
                    ->required()
                    ->reactive(),

                Textarea::make('komentar')
                    ->label('Komentar')
                    ->rows(5)
                    ->required(),

                FileUpload::make('gambar')
                    ->label('Lampiran Gambar (opsional)')
                    ->image()
                    ->directory('feedback')
                    ->maxSize(2048),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $user = auth('penduduk')->user();

        $gambar = $this->data['gambar'] ?? null;

        if (is_array($gambar)) {
            $gambar = reset($gambar); // ambil file pertama dari array
        }

        if ($gambar instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $gambar = $gambar->store('feedback', 'public');
        }

        Feedback::create([
            'penduduk_id' => $user->id,
            'kategori_id' => $this->data['kategori_id'],
            'rating' => $this->data['rating'],
            'komentar' => $this->data['komentar'],
            'gambar' => $gambar,
        ]);

        Notification::make()
            ->title('Feedback berhasil dikirim!')
            ->success()
            ->send();

        $this->form->fill(); // reset form
    }
}
