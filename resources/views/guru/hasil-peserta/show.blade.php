@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <a href="{{ route('guru-nilai.hasilpeserta') }}" class="btn btn-secondary mb-4">
                <i class="ti ti-arrow-narrow-left"></i>
                Kembali
            </a>
            <div class="card">
                <div class="card-header">
                    Hasil Test Peserta Didik
                </div>
                <div class="card-body">

                    @php
                        $nilais = \App\Models\NilaiSiswa::where('users_id', $users->id)->first();
                    @endphp
                    @if ($nilais)
                        <a href="{{ route('guru-nilai.exporthasil', $users->id) }}" class="btn btn-danger mb-3"
                            target="_blank">
                            Download Hasil Test
                        </a>
                    @endif

                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th width="15%">Gambar</th>
                                <th width="50%">Soal</th>
                                <th>Tingkat Miskonsepsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soals as $data)
                                @php
                                    $total = 0;
                                    $getNilais = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                                        ->where('users_id', $users->id)
                                        ->get();
                                    $countNilai = $getNilais->count();
                                    $getJawabanSoal = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                                        ->where('users_id', $users->id)
                                        ->whereNull('jawabansubsoal_id')
                                        ->get();
                                    $getJawabanSubs = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                                        ->where('users_id', $users->id)
                                        ->whereNotNull('jawabansubsoal_id')
                                        ->get();
                                    $countJawabanSoal = $getJawabanSoal->count();
                                    $countJawabanSubs = $getJawabanSubs->count();

                                    $totalJawabanSoal = 0;
                                    foreach ($getJawabanSoal as $nilai) {
                                        $totalJawabanSoal = $nilai->jawabansoal
                                            ? $nilai->jawabansoal->nilaijawabansoal
                                            : 0;
                                    }

                                    $totalSemuaJawabanSubSoal = 0;
                                    foreach ($getJawabanSubs as $vals) {
                                        $totalJawabanSubSoal = $vals->jawabansubsoal
                                            ? $vals->jawabansubsoal->nilaijawabansubsoal
                                            : 0;
                                        $totalSemuaJawabanSubSoal += $totalJawabanSubSoal / $countJawabanSubs;
                                    }

                                    // Menghitung nilai total
                                    if ($countNilai > 0) {
                                        $total = ($totalSemuaJawabanSubSoal + $totalJawabanSoal) / $countNilai;
                                    } else {
                                        $total = 0; // Atau Anda dapat memberikan nilai default lainnya jika pembagian tidak mungkin dilakukan
                                    }
                                    // $total = $totalSemuaJawabanSubSoal + $totalJawabanSoal;
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($data->gambarsoal)
                                            <img src="{{ asset('storage/' . $data->gambarsoal) }}" class="img-fluid"
                                                width="100">
                                        @else
                                            <img src="{{ asset('images/foto-profile.png') }}" class="img-fluid"
                                                width="100">
                                        @endif
                                    </td>
                                    <td>{{ $data->soal ?? '-' }}</td>
                                    <td>
                                        @if ($total >= 2.5)
                                            Menguasai Konsep
                                        @elseif($total >= 1)
                                            Kurang Pengetahuan
                                        @else
                                            Miskonsepsi
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@php
    $nilaiSoals = 0;
    $nilaiSubSoals = 0;
    $nilaiSiswas = \App\Models\NilaiSiswa::where('users_id', $users->id)->get();
    $countNilaiSiswas = $nilaiSiswas->count();

    if ($countNilaiSiswas > 0) {
        foreach ($nilaiSiswas as $jumlah) {
            $nilaiSoals += $jumlah->jawabansoal ? $jumlah->jawabansoal->nilaijawabansoal : 0;
            $nilaiSubSoals += $jumlah->jawabansubsoal ? $jumlah->jawabansubsoal->nilaijawabansubsoal : 0;
        }

        // Menghitung total nilai
        $totalNilaiSiswas = ($nilaiSoals + $nilaiSubSoals) / $countNilaiSiswas;

        // Membuat nilai menjadi genap atau dibagi 100
        $totalNilaiSiswas = round($totalNilaiSiswas); // Pembulatan ke nilai genap terdekat
        // Atau
        // $totalNilaiSiswas = round($totalNilaiSiswas / 100) * 100; // Pembulatan ke kelipatan 100 terdekat
    } else {
        $totalNilaiSiswas = 0; // Nilai default jika $countNilaiSiswas adalah nol
    }
@endphp
<?php $angka = $totalNilaiSiswas . 0; ?>


@push('custom-script')
    <script>
        var ctx = document.getElementById("canvas").getContext("2d");
        new Chart(ctx, {
            type: "tsgauge",
            data: {
                datasets: [{
                    backgroundColor: ['#ff0000', '#ffff00', '#008000'],
                    borderWidth: 0,
                    gaugeData: {
                        value: <?php echo $angka; ?>,
                        valueColor: "#ff7143"
                    },
                    gaugeLimits: [0, 35, 70, 100]
                }]
            },
            options: {
                events: [],
                showMarkers: true
            }
        });
    </script>
@endpush
