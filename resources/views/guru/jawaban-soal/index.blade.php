@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('guru-soal.index') }}" class="btn btn-info">
                        <i class="ti ti-arrow-narrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('guru-soal.createjawaban', $soals->id) }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Tambahkan Jawaban
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th width="60%">Jawaban</th>
                                <th width="10%">Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jawabans as $data)
                                <tr class="{{ $data->nilaijawabansoal == '1' ? 'bg-success text-white' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->jawabansoal ?? '-' }}</td>
                                    <td>{{ $data->nilaijawabansoal ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('guru-soal.editjawaban', $data->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('guru-soal.destroyjawaban', $data->id) }}" class="mx-2"
                                                method="POST" id="jawabanForm">
                                                @csrf
                                                <input type="text" name="soal_id" class="form-control"
                                                    value="{{ $data->soal_id }}" hidden>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
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
@push('custom-script')
    <script>
        // Mendengarkan acara pengiriman formulir
        document.getElementById('jawabanForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Hapus Data Jawaban!',
                text: 'Apakah Anda yakin ingin untuk menghapus data ini?',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan ke tindakan berikutnya, misalnya mengirimkan formulir
                if (result.isConfirmed) {
                    document.getElementById('jawabanForm').submit(); // Melanjutkan pengiriman formulir
                }
            });
        });
    </script>
    @include('sweetalert::alert')
@endpush
