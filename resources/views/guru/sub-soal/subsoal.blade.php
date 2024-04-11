@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('guru-subsoal.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-narrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('guru-subsoal.createsubsoal', $soals->id) }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Buat Jawaban Sub Soal
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th>Sub Soal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subs as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->subsoal }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('guru-subsoal.editsubsoal', $data->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="{{ route('guru-jawabansubs.index', $data->id) }}"
                                                class="btn btn-sm btn-warning mx-2">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <form action="{{ route('guru-subsoal.destroysubsoal', $data->id) }}"
                                                method="POST" id="subSoalForm">
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
        document.getElementById('subSoalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Hapus Data Sub Soal!',
                text: 'Apakah Anda yakin ingin untuk menghapus data ini?',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan ke tindakan berikutnya, misalnya mengirimkan formulir
                if (result.isConfirmed) {
                    document.getElementById('subSoalForm').submit(); // Melanjutkan pengiriman formulir
                }
            });
        });
    </script>
    @include('sweetalert::alert')
@endpush
