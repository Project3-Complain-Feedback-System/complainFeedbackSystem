<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Checkbox;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ViewField;

class LoginPenduduk extends Login
{
     protected static string $view = 'filament.auth.LoginPenduduk'; // View custom
    public $captchaValue; // nilai angka captcha saat ini

    public function mount(): void
    {
        parent::mount();
        $this->generateCaptcha();
    }

    //  Generate captcha 4 angka acak (0–9)
    public function generateCaptcha(): void
    {
        $this->captchaValue = collect(range(1, 4))
            ->map(fn () => rand(0, 9))
            ->join('');

        session(['captcha_value' => $this->captchaValue]);
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        // Validasi captcha
        if ($data['captcha'] != session('captcha_value')) {
            $this->generateCaptcha(); // refresh captcha saat salah
            throw ValidationException::withMessages([
                'captcha' => 'Captcha salah, silakan coba lagi.',
            ]);
        }

        //  Cek data penduduk
        $penduduk = \App\Models\Penduduk::where('nik', $data['nik'])
            ->where('tanggal_lahir', $data['tanggal_lahir'])
            ->first();

        if (! $penduduk) {
            $this->generateCaptcha(); // refresh juga kalau login gagal
            throw ValidationException::withMessages([
                'nik' => 'NIK atau tanggal lahir salah.',
            ]);
        }

        // Jika sukses login
        Auth::guard('penduduk')->login($penduduk, true);

        session()->forget('captcha_value');
        session()->regenerate();

        // sesuai return type parent
        return app(LoginResponse::class);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema([
                    TextInput::make('nik')
                        ->label('NIK')
                        ->required(),

                    DatePicker::make('tanggal_lahir')
                        ->label('Tanggal Lahir')
                        ->required(),

                    // Menampilkan captcha angka
                    ViewField::make('captcha_display')
                        ->view('components.CaptchaNumberPenduduk')
                        ->label(''),

                    // Input captcha
                    TextInput::make('captcha')
                        ->label('Masukkan angka di atas')
                        ->numeric()
                        ->required(),
                ])
                ->statePath('data'),
        ];
    }
}
