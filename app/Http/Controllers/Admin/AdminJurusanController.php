<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    public function index()
    {
        return view('admin.jurusan.index', [
            'jurusans' => Jurusan::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kodejurusan' => 'required',
            'namajurusan' => 'required',
        ], [
            'kodejurusan.required' => 'Kode Jurusan wajib diisi',
            'namajurusan.required' => 'Nama Jurusan wajib diisi',
        ]);

        $validated['deskripsijurusan'] = $request->deskripsijurusan ?? null;

        Jurusan::create($validated);

        return redirect('data-jurusan')->with('success', 'Anda berhasil menambahkan data jurusan');
    }

    public function edit($id)
    {
        return view('admin.jurusan.edit', [
            'jurusans' => Jurusan::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kodejurusan' => 'required',
            'namajurusan' => 'required',
        ], [
            'kodejurusan.required' => 'Kode Jurusan wajib diisi',
            'namajurusan.required' => 'Nama Jurusan wajib diisi',
        ]);

        $validated['deskripsijurusan'] = $request->deskripsijurusan ?? null;

        Jurusan::where('id', $id)->update($validated);

        return redirect('data-jurusan')->with('success', 'Anda berhasil mengupdate data jurusan');
    }

    public function destroy($id)
    {
        Jurusan::where('id', $id)->delete();

        return redirect('data-jurusan')->with('success', 'Anda berhasil menghapus data jurusan');
    }
}
