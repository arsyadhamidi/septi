<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.index');
    }

    public function updateprofile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'telp' => 'required',
        ], [
            'name.required' => 'Nama Lengkap wajid diisi',
            'telp.required' => 'Nomor Telepon wajib diisi',
        ]);

        User::where('id', Auth()->user()->id)->update($validated);

        return redirect('setting')->with('success', 'Anda berhasil mengupdate data profile');
    }

    public function updateusername(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users',
        ], [
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan',
        ]);

        User::where('id', Auth()->user()->id)->update($validated);
        return redirect('setting')->with('success', 'Anda berhasil mengupdate username baru');
    }

    public function updatepassword(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|min:8',
            'konfirmasipassword' => 'required|min:8',
        ], [
            'password.required' => 'Password wajib diisi',
            'konfirmasipassword.required' => 'Konfirmasi Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'konfirmasipassword.min' => 'Konfirmasi Password minimal 8 karakter',
        ]);

        $checkPassword = $request->password;
        $checkKonfirmasi = $request->konfirmasipassword;

        if ($checkPassword !== $checkKonfirmasi) {
            return back()->with('error', 'Password dan Konfirmasi tidak sesuai');
        }

        User::where('id', Auth()->user()->id)->update([
            'password' => Hash::make($checkPassword),
        ]);

        return redirect('setting')->with('success', 'Anda berhasil mengupdate password');
    }

    public function updategambar(Request $request)
    {
        $validated = $request->validate([
            'foto_profile' => 'required|mimes:png,jpg,jpeg',
        ], [
            'foto_profile.required' => 'Foto Profile wajib diisi!',
            'foto_profile.mimes' => 'Foto Profile berformat PNG, JPG, atau JPEG',
        ]);

        if (empty($validated)) {
            return back()->with('error', 'Data yang anda inputkan kosong');
        } else {

            if (Auth()->user()->foto_profile) {
                Storage::delete(Auth()->user()->foto_profile);
            }

            if ($request->file('foto_profile')) {
                $validated['foto_profile'] = $request->file('foto_profile')->store('foto_profile');
            }

            User::where('id', Auth()->user()->id)->update([
                'foto_profile' => $validated['foto_profile'],
            ]);

            return redirect('setting')->with('success', 'Anda berhasil mengupdate foto profile');
        }

    }

    public function deletegambar(Request $request)
    {
        $user = User::where('id', Auth()->user()->id)->first();

        if (!$user) {
            return redirect('/setting')->with('error', 'User tidak ditemukan.');
        }

        // Delete the associated image file
        if ($user->foto_profile) {
            Storage::delete($user->foto_profile);
        }

        // Remove the reference to the image in the database
        $user->update([
            'foto_profile' => null,
        ]);

        return redirect('setting')->with('success', 'Foto profile berhasil di hapus');
    }

}
