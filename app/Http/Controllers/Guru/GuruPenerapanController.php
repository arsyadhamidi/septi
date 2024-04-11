<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Soal;

class GuruPenerapanController extends Controller
{
    public function index()
    {
        return view('guru.penerapan.index', [
            'soals' => Soal::get(),
        ]);
    }
}
