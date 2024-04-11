<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function jawabansoal()
    {
        return $this->belongsTo(JawabanSoal::class, 'jawabansoal_id');
    }

    public function jawabansubsoal()
    {
        return $this->belongsTo(JawabanSubSoal::class, 'jawabansubsoal_id');
    }
}
