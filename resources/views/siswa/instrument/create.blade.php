@extends('admin.layout.master')

@section('content')
    <form action="{{ route('siswa-instrument.store') }}" method="POST" id="soalForm">
        @csrf
        <div class="row">
            <div class="col-lg">
                @foreach ($soals as $data)
                    <div class="card">
                        <div class="card-header">
                            SOAL NOMOR {{ $loop->iteration }}
                        </div>
                        <div class="card-body">
                            @if ($data->gambarsoal)
                                <img src="{{ asset('storage/' . $data->gambarsoal) }}" class="img-fluid" width="150">
                            @endif
                            <p class="mt-5">{{ $data->soal ?? '-' }}</p>

                            @php
                                $jawabans = \App\Models\JawabanSoal::where('soal_id', $data->id)->get();
                            @endphp

                            <!-- Jawaban Soal -->
                            @foreach ($jawabans as $jawaban)
                                <div class="form-check mt-3">
                                    <input type="radio" name="jawabansoals[{{ $data->id }}]"
                                        id="jawabanSoal{{ $jawaban->id }}" class="form-check-input"
                                        value="{{ $jawaban->id }}">
                                    <label for="jawabanSoal{{ $jawaban->id }}">{{ $jawaban->jawabansoal ?? '-' }}</label>
                                </div>
                            @endforeach

                            @php
                                $subSoal = \App\Models\SubSoal::where('soal_id', $data->id)->get();
                            @endphp

                            @foreach ($subSoal as $val)
                                <p class="mt-3">{{ $loop->iteration }}. {{ $val->subsoal ?? '-' }}</p>

                                @php
                                    $jawabanSubs = \App\Models\JawabanSubSoal::where('subsoal_id', $val->id)->get();
                                @endphp

                                @foreach ($jawabanSubs as $jawabansub)
                                    <div class="form-check mt-3">
                                        <input type="radio" name="jawabansubsoals[{{ $val->id }}]"
                                            id="jawabanSubsoal{{ $jawabansub->id }}" class="form-check-input"
                                            value="{{ $jawabansub->id }}">
                                        <label
                                            for="jawabanSubsoal{{ $jawabansub->id }}">{{ $jawabansub->jawabansubsoal ?? '-' }}</label>
                                    </div>
                                @endforeach
                            @endforeach

                        </div>
                    </div>
                @endforeach

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-success">
                        Kirim
                    </button>
                    <a href="{{ route('siswa-instrument.index') }}" class="btn btn-danger mx-2">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('custom-script')
    <script>
        // Mendengarkan acara pengiriman formulir
        document.getElementById('soalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Selesaikan Ujian Anda!',
                text: 'Apakah Anda yakin ingin untuk mengakhiri ujian ini?',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan ke tindakan berikutnya, misalnya mengirimkan formulir
                if (result.isConfirmed) {
                    document.getElementById('soalForm').submit(); // Melanjutkan pengiriman formulir
                }
            });
        });
    </script>
@endpush
