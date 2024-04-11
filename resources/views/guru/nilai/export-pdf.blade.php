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
    <p style="text-align: center">{{ $users->name ?? '-' }} ({{ $users->username ?? '-' }})</p>

    <table style="width: 100%; border-collapse: collapse">
        <tr style="border: 1px solid black">
            <th style="width: 3%; border-right: 1px solid black">No.</th>
            <th style="border-right: 1px solid black">Soal</th>
            <th style="border-right: 1px solid black">Nilai</th>
        </tr>
        @foreach ($nilais as $data)
            <tr style="border: 1px solid black">
                <td style="width: 3%; border-right: 1px solid black; text-align: center">{{ $loop->iteration }}</td>
                <td style="border-right: 1px solid black">
                    <p>{{ $data->jawabansoal->soal->soal ?? '-' }}</p>
                </td>
                <td width="5%" style="text-align: center">
                    <p>{{ $data->jawabansoal->nilaijawabansoal ?? '-' }}</p>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
