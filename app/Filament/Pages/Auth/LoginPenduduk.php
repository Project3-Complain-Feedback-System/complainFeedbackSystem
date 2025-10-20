<?php

namespace App\Filament\Pages\Auth;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginPenduduk extends Login
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        $penduduk = \App\Models\Penduduk::where('nik', $data['nik'])
            ->where('tanggal_lahir', $data['tanggal_lahir'])
            ->first();

        if (! $penduduk) {
            throw ValidationException::withMessages([
                'nik' => 'NIK atau tanggal lahir salah.',
            ]);
        }

        Auth::guard('penduduk')->login($penduduk, true);

        session()->regenerate();

        // sesuai return type parent
        return app(LoginResponse::class);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->schema([
                    \Filament\Forms\Components\TextInput::make('nik')
                        ->label('NIK')
                        ->required(),
                    \Filament\Forms\Components\DatePicker::make('tanggal_lahir')
                        ->label('Tanggal Lahir')
                        ->required(),
                ])
                ->statePath('data'),
        ];
    }
}
