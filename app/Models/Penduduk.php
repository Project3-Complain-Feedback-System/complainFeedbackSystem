<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Penduduk extends Authenticatable implements FilamentUser
{
    use HasApiTokens;

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $panel->getId() === 'penduduk';
    }

    protected $fillable = [
        'nik',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'status_dalam_keluarga',
        'pendidikan',
        'nama_ayah',
        'nama_ibu',
    ];

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
