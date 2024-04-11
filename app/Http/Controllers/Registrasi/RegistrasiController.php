<?php

namespace App\Http\Controllers\Registrasi;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telp' => 'required',
        ]);

        $validated['level'] = 'Guru';
        $validated['password'] = bcrypt($request->password);

        User::create($validated);

        return redirect('/login')->with('success', 'Anda berhasil melakukan registrasi');
    }
}
