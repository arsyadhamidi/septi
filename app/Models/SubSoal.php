<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSoal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}
