<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hasil Tes Peserta Didik</title>
    <style>
        body {
            font-family: sans-serif;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center">Hasil Tes Peserta Didik</h2>
    <p style="text-align: center">{{ Auth()->user()->name ?? '-' }} ({{ Auth()->user()->username ?? '-' }})</p>

    <table style="width: 100%; border-collapse: collapse">
        <tr style="border: 1px solid black">
            <th style="width: 3%; border-right: 1px solid black">No.</th>
            <th style="border-right: 1px solid black">Soal</th>
            <th style="border-right: 1px solid black">Tingkat Miskonsepsi</th>
        </tr>
        @foreach ($soals as $data)
            @php
                $total = 0;
                $getNilais = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                    ->where('users_id', Auth()->user()->id)
                    ->get();
                $countNilai = $getNilais->count();
                $getJawabanSoal = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                    ->where('users_id', Auth()->user()->id)
                    ->whereNull('jawabansubsoal_id')
                    ->get();
                $getJawabanSubs = \App\Models\NilaiSiswa::where('soal_id', $data->id)
                    ->where('users_id', Auth()->user()->id)
                    ->whereNotNull('jawabansubsoal_id')
                    ->get();
                $countJawabanSoal = $getJawabanSoal->count();
                $countJawabanSubs = $getJawabanSubs->count();

                $totalJawabanSoal = 0;
                foreach ($getJawabanSoal as $nilai) {
                    $totalJawabanSoal = $nilai->jawabansoal ? $nilai->jawabansoal->nilaijawabansoal : 0;
                }

                $totalSemuaJawabanSubSoal = 0;
                foreach ($getJawabanSubs as $vals) {
                    $totalJawabanSubSoal = $vals->jawabansubsoal ? $vals->jawabansubsoal->nilaijawabansubsoal : 0;
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
            <tr style="border: 1px solid black">
                <td style="width: 3%; border-right: 1px solid black; text-align: center">{{ $loop->iteration }}</td>
                <td style="border-right: 1px solid black">
                    @if ($data->gambarsoal)
                        <img src="{{ public_path('storage/' . $data->gambarsoal) }}" class="img-fluid" width="100">
                    @endif
                    <p>{{ $data->soal ?? '-' }}</p>
                </td>
                <td style="border-right: 1px solid black">
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
    </table>
</body>

</html>
