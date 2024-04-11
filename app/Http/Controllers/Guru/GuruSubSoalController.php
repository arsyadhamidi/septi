<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanSubSoal;
use App\Models\Soal;
use App\Models\SubSoal;
use Illuminate\Http\Request;

class GuruSubSoalController extends Controller
{
    public function index()
    {
        return view('guru.sub-soal.index', [
            'soals' => Soal::latest()->get(),
        ]);
    }

    public function subsoal($id)
    {
        return view('guru.sub-soal.subsoal', [
            'subs' => SubSoal::where('soal_id', $id)->latest()->get(),
            'soals' => Soal::where('id', $id)->first(),
        ]);
    }

    public function createsubsoal($id)
    {
        return view('guru.sub-soal.create', [
            'soals' => Soal::where('id', $id)->first(),
        ]);
    }

    public function storesubsoal(Request $request)
    {
        $validated = $request->validate([
            'subsoal' => 'required',
        ], [
            'subsoal.required' => 'Sub Soal wajid diisi',
        ]);

        $validated['soal_id'] = $request->soal_id;

        SubSoal::create($validated);

        return redirect('guru-subsoal/subsoal/' . $request->soal_id)->with('success', 'Anda berhasil membuat sub soal baru');
    }

    public function editsubsoal($id)
    {
        return view('guru.sub-soal.edit', [
            'subs' => SubSoal::where('id', $id)->first(),
        ]);
    }

    public function updatesubsoal(Request $request, $id)
    {
        $validated = $request->validate([
            'subsoal' => 'required',
        ], [
            'subsoal.required' => 'Sub Soal wajid diisi',
        ]);

        $validated['soal_id'] = $request->soal_id;

        SubSoal::where('id', $id)->update($validated);

        return redirect('guru-subsoal/subsoal/' . $request->soal_id)->with('success', 'Anda berhasil mengupdate sub soal baru');
    }

    public function destroysubsoal(Request $request, $id)
    {
        SubSoal::where('id', $id)->delete();
        return redirect('guru-subsoal/subsoal/' . $request->soal_id)->with('success', 'Anda berhasil menghapus sub soal baru');
    }

    public function indexjawabansubsoal($id)
    {
        return view('guru.jawaban-subs.index', [
            'jawabans' => JawabanSubSoal::where('subsoal_id', $id)->latest()->get(),
            'subs' => SubSoal::where('id', $id)->first(),
        ]);
    }

    public function createjawabansubsoal($id)
    {
        return view('guru.jawaban-subs.create', [
            'subs' => SubSoal::where('id', $id)->first(),
        ]);
    }

    public function storejawabansubsoal(Request $request)
    {
        $validated = $request->validate([
            'soal_id' => 'required',
            'subsoal_id' => 'required',
            'jawabansubsoal' => 'required',
            'nilaijawabansubsoal' => 'required',
        ], [
            'jawabansubsoal.required' => 'Jawaban Sub Soal wajib diisi',
            'nilaijawabansubsoal.required' => 'Nilai Jawaban Sub Soal wajib diisi',
        ]);

        JawabanSubSoal::create($validated);

        return redirect('guru-jawabansubs/' . $request->subsoal_id)->with('success', 'Anda berhasil menambahkan jawaban sub soal');
    }

    public function editjawabansubsoal($id)
    {
        return view('guru.jawaban-subs.edit', [
            'jawabans' => JawabanSubSoal::where('id', $id)->first(),
        ]);
    }

    public function updatejawabansubsoal(Request $request, $id)
    {
        $validated = $request->validate([
            'soal_id' => 'required',
            'subsoal_id' => 'required',
            'jawabansubsoal' => 'required',
            'nilaijawabansubsoal' => 'required',
        ], [
            'jawabansubsoal.required' => 'Jawaban Sub Soal wajib diisi',
            'nilaijawabansubsoal.required' => 'Nilai Jawaban Sub Soal wajib diisi',
        ]);

        JawabanSubSoal::where('id', $id)->update($validated);

        return redirect('guru-jawabansubs/' . $request->subsoal_id)->with('success', 'Anda berhasil mengupdate jawaban sub soal');
    }

    public function destroyjawabansubsoal(Request $request, $id)
    {
        JawabanSubSoal::where('id', $id)->delete();
        return redirect('guru-jawabansubs/' . $request->subsoal_id)->with('success', 'Anda berhasil menghapus jawaban sub soal');
    }
}
