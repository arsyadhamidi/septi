<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanSoal;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruSoalController extends Controller
{
    public function index()
    {
        return view('guru.soal.index', [
            'soals' => Soal::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('guru.soal.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'soal' => 'required',
        ], [
            'soal.required' => 'Soal wajib diisi',
        ]);

        if ($request->file('gambarsoal')) {
            $validated['gambarsoal'] = $request->file('gambarsoal')->store('gambarsoal');
        } else {
            $validated['gambarsoal'] = null;
        }

        Soal::create($validated);

        return redirect('guru-soal')->with('success', 'Anda berhasil menambahkan soal');
    }

    public function edit($id)
    {
        return view('guru.soal.edit', [
            'soals' => Soal::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'soal' => 'required',
        ], [
            'soal.required' => 'Soal wajib diisi',
        ]);

        $soals = Soal::where('id', $id)->first();

        if ($request->file('gambarsoal')) {
            if ($soals->gambarsoal) {
                Storage::delete($soals->gambarsoal);
            }

            $validated['gambarsoal'] = $request->file('gambarsoal')->store('gambarsoal');
        } else {
            $validated['gambarsoal'] = $soals->gambarsoal;
        }

        $soals->update($validated);

        return redirect('guru-soal')->with('success', 'Anda berhasil mengupdate soal');
    }

    public function destroy($id)
    {
        $soals = Soal::where('id', $id)->first();
        if ($soals->gambarsoal) {
            Storage::delete($soals->gambarsoal);
        }

        $soals->delete();
        return redirect('guru-soal')->with('success', 'Anda berhasil menghapus soal');
    }

    public function show($id)
    {
        return view('guru.jawaban-soal.index', [
            'jawabans' => JawabanSoal::where('soal_id', $id)->latest()->get(),
            'soals' => Soal::where('id', $id)->first(),
        ]);
    }

    public function createjawaban($id)
    {
        return view('guru.jawaban-soal.create', [
            'soals' => Soal::where('id', $id)->first(),
        ]);
    }

    public function storejawaban(Request $request)
    {
        $validated = $request->validate([
            'jawabansoal' => 'required',
            'nilaijawabansoal' => 'required',
        ], [
            'jawabansoal.required' => 'Jawaban Soal wajib diisi',
            'nilaijawabansoal.required' => 'Nilai Jawaban Soal wajib diisi',
        ]);

        $validated['soal_id'] = $request->soal_id;

        JawabanSoal::create($validated);

        return redirect('guru-soal/show/' . $request->soal_id)->with('success', 'Anda berhasil menambahkan jawaban');
    }

    public function editjawaban($id)
    {
        return view('guru.jawaban-soal.edit', [
            'jawabans' => JawabanSoal::where('id', $id)->first(),
        ]);
    }

    public function updatejawaban(Request $request, $id)
    {
        $validated = $request->validate([
            'jawabansoal' => 'required',
            'nilaijawabansoal' => 'required',
        ], [
            'jawabansoal.required' => 'Jawaban Soal wajib diisi',
            'nilaijawabansoal.required' => 'Nilai Jawaban Soal wajib diisi',
        ]);

        $validated['soal_id'] = $request->soal_id;

        JawabanSoal::where('id', $id)->update($validated);

        return redirect('guru-soal/show/' . $request->soal_id)->with('success', 'Anda berhasil mengupdate jawaban');
    }

    public function destroyjawaban(Request $request, $id)
    {
        JawabanSoal::where('id', $id)->delete();
        return redirect('guru-soal/show/' . $request->soal_id)->with('success', 'Anda berhasil menghapus jawaban');
    }
}
