<?php

namespace App\Http\Controllers\Siswa;

use PDF;
use App\Models\Soal;
use App\Models\NilaiSiswa;
use App\Http\Controllers\Controller;

class SiswaNilaiController extends Controller
{
    public function index()
    {
        return view('siswa.nilai.index', [
            'soals' => Soal::all(),
        ]);
    }

    public function generatePDF()
    {
        // Load semua soal sekali saja
        $soals = Soal::all();

        // Load semua nilai siswa sekali saja
        $user_id = auth()->user()->id;
        $nilai_siswas = NilaiSiswa::where('users_id', $user_id)->get()->groupBy('soal_id');

        $pdf = PDF::loadview('siswa.nilai.export-pdf', compact('soals', 'nilai_siswas'))->setPaper('a4', 'landscape');
        return $pdf->stream('hasil-tes.pdf');
    }
}
