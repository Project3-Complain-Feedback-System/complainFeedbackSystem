<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ViewField;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;

class LoginAdmin extends Login
{
    protected static string $view = 'filament.auth.LoginAdmin'; // View custom kamu

    public $captchaValue;


    public function mount(): void
    {
        parent::mount();
        $this->generateCaptcha();
    }

    /**
     * Generate captcha acak 4 digit
     */
    public function generateCaptcha(): void
    {
        $this->captchaValue = collect(range(1, 4))
            ->map(fn() => rand(0, 9))
            ->join('');

        session(['captcha_admin' => $this->captchaValue]);
    }

    /**
     * Validasi login dan captcha
     */
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $errors = [];

        // Validasi captcha dulu
        if (($data['captcha'] ?? null) !== session('captcha_admin')) {
            $errors['captcha'] = 'Captcha salah, silakan coba lagi.';
        }

        // Tetap coba autentikasi meskipun captcha salah
        try {
            parent::authenticate();
        } catch (ValidationException $e) {
            $errors['email'] = 'Email atau password salah.';
        }

        // Jika ada error (captcha atau login), tampilkan semua sekaligus
        if (!empty($errors)) {
            $this->generateCaptcha();

            throw ValidationException::withMessages($errors);
        }

        //  Jika berhasil login
        session()->forget('captcha_admin');
        session()->regenerate();

        return app(LoginResponse::class);
    }

    /**
     * Definisikan form login
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema([
                    TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->autofocus(),

                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->revealable()
                        ->required(),

                    Checkbox::make('remember')
                        ->label('Ingat saya'),

                    ViewField::make('captcha_display')
                        ->view('components.CaptchaNumberAdmin'),

                    TextInput::make('captcha')
                        ->label('Masukkan angka di atas')
                        ->numeric()
                        ->required(),
                ])
                ->statePath('data'),
        ];
    }
}
