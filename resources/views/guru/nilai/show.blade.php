@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('guru-nilai.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-narrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('guru-nilai.exportpdf', $users->id) }}" class="btn btn-danger" target="_blank">
                        Download PDF
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="myTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="3%"></th>
                                <th>Soal</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilais as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->jawabansoal->soal->soal ?? '-' }}</td>
                                    <td>{{ $data->jawabansoal->nilaijawabansoal ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
