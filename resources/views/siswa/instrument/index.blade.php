@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card border">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg text-center">
                            <h1>Petunjuk Pengerjaan Tes</h1>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-lg">
                            <img src="{{ asset('images/vektor.png') }}" alt="gambar" class="img-fluid">
                        </div>
                        <div class="col-lg">
                            <ol>
                                <li>
                                    <div class="mb-3">
                                        <h6 class="text-primary">
                                            SEBELUM MENGERJAKAN TES, HARAP PERHATIKAN
                                            HAL-HAL BERIKUT
                                        </h6>
                                        <p>
                                            Pastikan Koneksi Internet Stabil
                                            Gunakan Browser: Mozila Firefox Atau Google Chrome
                                            Siapkan Kertas Dan Pensil/Pulpen Untuk Mencoret-
                                            Coret Jika Diperlukan
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="mb-3">
                                        <h6 class="text-primary">
                                            WAKTU PENGERJAAN TES DITENTUKAN OLEH PENDIDIK
                                        </h6>
                                    </div>
                                </li>
                                <li>
                                    <div class="mb-3">
                                        <h6 class="text-primary">
                                            PESERTA DIDIK WAJIB MENJAWAB SELURUH SOAL
                                            YANG TERDIRI ATAS
                                        </h6>
                                        <p>
                                            Pertanyaan <br>
                                            Keyakinan Menjawab Pertanyaan <br>
                                            Alasan Menjawab Pertanyaan <br>
                                            Keyakinan Menjawab Alasan <br>
                                            Sumber Menjawab Pertanyaan
                                        </p>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg text-center">
                            @php
                                $nilais = \App\Models\NilaiSiswa::where('users_id', Auth()->user()->id)->first();
                            @endphp
                            @if ($nilais == null)
                                <a href="{{ route('siswa-instrument.create') }}" class="btn btn-success">
                                    Kerjakan Sekarang
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
