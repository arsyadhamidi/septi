<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSoal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class, 'soal_id');
    }
}
