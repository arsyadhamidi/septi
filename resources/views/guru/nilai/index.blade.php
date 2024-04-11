@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    Data Hasil Test Peserta Didik
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%">No.</th>
                                <th>Nama Lengkap</th>
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
                                        <a href="{{ route('guru-nilai.show', $data->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ti ti-eye"></i>
                                        </a>
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
