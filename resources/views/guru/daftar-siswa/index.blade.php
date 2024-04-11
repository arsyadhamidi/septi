@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('daftar-siswa.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i>
                        Daftarkan Siswa
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->name ?? '-' }}</td>
                                    <td>{{ $data->username ?? '-' }}</td>
                                    <td>{{ $data->level ?? '-' }}</td>
                                    <td>{{ $data->telp ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('daftar-siswa.edit', $data->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="{{ route('daftar-siswa.destroy', $data->id) }}" method="POST"
                                                class="mx-2" id="userForm">
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
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir standar

            // Tampilkan SweetAlert saat formulir dikirim
            Swal.fire({
                icon: 'info',
                title: 'Hapus Data Siswa!',
                text: 'Apakah Anda yakin ingin untuk menghapus data ini?',
                showCancelButton: true, // Menampilkan tombol batal
                confirmButtonText: 'Ya',
                confirmButtonColor: '#28a745', // Warna hijau untuk tombol konfirmasi
                cancelButtonText: 'Tidak',
                cancelButtonColor: '#dc3545' // Warna merah untuk tombol pembatalan
            }).then((result) => {
                // Lanjutkan ke tindakan berikutnya, misalnya mengirimkan formulir
                if (result.isConfirmed) {
                    document.getElementById('userForm').submit(); // Melanjutkan pengiriman formulir
                }
            });
        });
    </script>
    @include('sweetalert::alert')
@endpush
