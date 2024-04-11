<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\NilaiSiswa;
use App\Models\Soal;
use App\Models\User;
use PDF;

class GuruNilaiController extends Controller
{
    public function index()
    {
        $nilais = User::whereHas('nilaisiswa', function ($query) {
            $query->whereNotNull('users_id');
        })->latest()->get();
        return view('guru.nilai.index', [
            'users' => $nilais,
        ]);
    }

    public function show($id)
    {
        $nilais = NilaiSiswa::where('users_id', $id)->whereNotNull('jawabansoal_id')->get();
        $users = User::where('id', $id)->first();

        return view('guru.nilai.show', [
            'nilais' => $nilais,
            'users' => $users,
        ]);
    }

    public function generatePDF($id)
    {
        $nilais = NilaiSiswa::where('users_id', $id)->whereNotNull('jawabansoal_id')->get();
        $users = User::where('id', $id)->first();

        $pdf = PDF::loadview('guru.nilai.export-pdf', compact('nilais', 'users'))->setPaper('a4', 'landscape');
        return $pdf->stream('hasil-tes.pdf');
    }

    public function hasilpeserta()
    {
        $nilais = User::whereHas('nilaisiswa', function ($query) {
            $query->whereNotNull('users_id');
        })->latest()->get();

        return view('guru.hasil-peserta.index', [
            'users' => $nilais,
        ]);
    }

    public function showhasilpeserta($id)
    {
        return view('guru.hasil-peserta.show', [
            'soals' => Soal::all(),
            'users' => User::where('id', $id)->first(),
        ]);
    }

    public function generateHasilPesertaPDF($id)
    {
        // Load semua soal sekali saja
        $soals = Soal::all();

        // Load semua nilai siswa sekali saja
        $users = User::where('id', $id)->first();
        $nilai_siswas = NilaiSiswa::where('users_id', $users)->get()->groupBy('soal_id');

        $pdf = PDF::loadview('guru.hasil-peserta.export-pdf', compact('soals', 'nilai_siswas', 'users'))->setPaper('a4', 'landscape');
        return $pdf->stream('hasil-tes.pdf');
    }
}
