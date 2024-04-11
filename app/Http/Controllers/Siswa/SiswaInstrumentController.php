<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\NilaiSiswa;
use App\Models\Soal;
use Illuminate\Http\Request;

class SiswaInstrumentController extends Controller
{
    public function index()
    {
        return view('siswa.instrument.index');
    }

    public function create()
    {
        return view('siswa.instrument.create', [
            'soals' => Soal::get(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'jawabansoals' => 'required',
            'jawabansubsoals' => 'required',
        ]);

        // Loop melalui data soal untuk menyimpan jawaban
        if ($request->has('jawabansoals')) {
            foreach ($request->jawabansoals as $soalId => $jawaban) {
                // Simpan jawaban untuk soal utama
                NilaiSiswa::create([
                    'users_id' => auth()->user()->id,
                    'soal_id' => $soalId, // Tambahkan soal_id di sini
                    'jawabansoal_id' => $jawaban,
                ]);
            }
        }

        // Loop melalui data subsoal untuk menyimpan jawaban
        if ($request->has('jawabansubsoals')) {
            foreach ($request->jawabansubsoals as $subsoalId => $jawaban) {
                // Dapatkan id soal dari subsoal
                $soalId = \App\Models\SubSoal::findOrFail($subsoalId)->soal_id;
                // Simpan jawaban untuk subsoal
                NilaiSiswa::create([
                    'users_id' => auth()->user()->id,
                    'soal_id' => $soalId, // Tambahkan soal_id di sini
                    'jawabansubsoal_id' => $jawaban,
                    'jawaban' => $subsoalId,
                ]);
            }
        }

        // Redirect ke halaman yang sesuai setelah menyimpan data
        return redirect('siswa-nilai');
    }

}
