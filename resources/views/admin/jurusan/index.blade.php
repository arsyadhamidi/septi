@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card shadow">
                <div class="card-header">
                    <a href="{{ route('data-jurusan.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Tambah Jurusan
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurusans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kodejurusan ?? '-' }}</td>
                                    <td>{{ $data->namajurusan ?? '-' }}</td>
                                    <td>{!! $data->deskripsijurusan ?? '-' !!}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('data-jurusan.edit', $data->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('data-jurusan.destroy', $data->id) }}" method="POST"
                                                class="mx-2" id="jurusanForm">
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
        document.getElementById('jurusanForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Hapus Data Jurusan!',
                text: 'Apakah Anda yakin ingin untuk menghapus data ini?',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan ke tindakan berikutnya, misalnya mengirimkan formulir
                if (result.isConfirmed) {
                    document.getElementById('jurusanForm').submit(); // Melanjutkan pengiriman formulir
                }
            });
        });
    </script>
    @include('sweetalert::alert')
@endpush
