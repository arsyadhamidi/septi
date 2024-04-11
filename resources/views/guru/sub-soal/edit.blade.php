@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('guru-subsoal.updatesubsoal', $subs->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('guru-subsoal.subsoal', $subs->soal_id) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-narrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <input type="text" name="soal_id" class="form-control" value="{{ $subs->id }}" hidden>
                        <div class="mb-3">
                            <label>Sub Soal</label>
                            <input type="text" name="subsoal" class="form-control @error('subsoal') is-invalid @enderror"
                                value="{{ old('subsoal', $subs->subsoal) }}" placeholder="Masukan sub soal">
                            @error('subsoal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="ti ti-device-floppy"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
