@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('guru-soal.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Buat Soal
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th width="10%">Gambar</th>
                                <th width="65%">Soal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soals as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($data->gambarsoal)
                                            <img src="{{ asset('storage/' . $data->gambarsoal) }}" alt="gambar"
                                                class="img-fluid" width="100">
                                        @else
                                            <img src="{{ asset('images/foto-profile.png') }}" alt="gambar"
                                                class="img-fluid" width="100">
                                        @endif
                                    </td>
                                    <td>{{ $data->soal ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('guru-soal.edit', $data->id) }}" class="btn btn-sm btn-info">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <a href="{{ route('guru-soal.show', $data->id) }}"
                                                class="btn btn-sm btn-warning mx-2">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <form action="{{ route('guru-soal.destroy', $data->id) }}" method="POST"
                                                id="soalForm">
                                                @csrf
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
        document.getElementById('soalForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Hapus Data Soal!',
                text: 'Apakah Anda yakin ingin untuk menghapus data ini?',
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
    @include('sweetalert::alert')
@endpush
