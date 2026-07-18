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
        // form
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
                    ->maxSize(20048)
                    ->directory('feedback'),
            ])
            ->statePath('data');
    }

    //fun buat summit form
    public function submit(): void {

    $user = auth('penduduk')->user();
    // Rate Limit
    $hourKey = 'feedback-hour-' . $user->id;
    $dayKey  = 'feedback-day-' . $user->id;

    // Max 3 feedback per JAM
    if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($hourKey, 3)) {
        Notification::make()
            ->title('Terlalu sering mengirim feedback')
            ->body('Maksimal 3 feedback dalam 1 jam.')
            ->danger()
            ->send();
        return;
    }

    //Max 10 feedback per HARI
    if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($dayKey, 10)) {
        Notification::make()
            ->title('Batas harian tercapai')
            ->body('Maksimal 10 feedback per hari.')
            ->danger()
            ->send();
        return;
    }
    //$data = $this->form->getState();
    //ambil data form
    $validatedData = $this->form->getState();

    //$user = auth('penduduk')->user();

    //Simpan Data
    $gambar = $validatedData['gambar'] ?? null;

    if (is_array($gambar)) {
        $gambar = reset($gambar);
    }

    if ($gambar instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
        $gambar = $gambar->store('feedback', 'public');
    }

    Feedback::create([
        'penduduk_id' => $user->id,
        'kategori_id' => $validatedData['kategori_id'],
        'rating'      => $validatedData['rating'],
        'komentar'    => $validatedData['komentar'],
        'gambar'      => $gambar,
        'status'      => 'pending',
    ]);

    Notification::make()
        ->title('Feedback berhasil dikirim!')
        ->success()
        ->send();

    $this->form->fill();



    \Illuminate\Support\Facades\RateLimiter::hit($hourKey, 3600);
    \Illuminate\Support\Facades\RateLimiter::hit($dayKey, 86400);

    //Delay buatan (anti bot)
    sleep(2);


    }

}
