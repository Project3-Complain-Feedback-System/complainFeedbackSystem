<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'rating',
        'komentar',
        'gambar',
        'penduduk_id',
        'kategori_id',
        'status',
    ];



    //Relasi
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'penduduk_id');
    }

    /*public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isDone(): bool
    {
        return $this->status === 'done';
    }*/
}
