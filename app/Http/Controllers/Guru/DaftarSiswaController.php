<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DaftarSiswaController extends Controller
{
    public function index()
    {
        return view('guru.daftar-siswa.index', [
            'users' => User::where('level', 'Siswa')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('guru.daftar-siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'telp' => 'required',
        ], [
            'name.required' => 'Nama Lengkap wajid diisi',
            'username.required' => 'Username wajid diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password wajid diisi',
            'password.min' => 'Password minimal 8 karakter',
            'telp.required' => 'Telp / Wa wajib diisi',
        ]);

        $validated['level'] = 'Siswa';
        $validated['password'] = bcrypt($request->password);

        User::create($validated);

        return redirect('daftar-siswa')->with('success', 'Anda berhasil mendaftarkan siswa');
    }

    public function edit($id)
    {
        return view('guru.daftar-siswa.edit', [
            'users' => User::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'telp' => 'required',
        ], [
            'name.required' => 'Nama Lengkap wajid diisi',
            'username.required' => 'Username wajid diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password wajid diisi',
            'password.min' => 'Password minimal 8 karakter',
            'telp.required' => 'Telp / Wa wajib diisi',
        ]);

        $validated['level'] = 'Siswa';
        $validated['password'] = bcrypt($request->password);

        User::where('id', $id)->update($validated);

        return redirect('daftar-siswa')->with('success', 'Anda berhasil mengupdate siswa');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('daftar-siswa')->with('success', 'Anda berhasil menghapus siswa');
    }
}
