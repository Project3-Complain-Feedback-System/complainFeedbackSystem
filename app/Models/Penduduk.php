<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Penduduk extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'nik',
        'nama',
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
        'nama_ibu'
    ];
}
