@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('guru-soal.update', $soals->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('guru-soal.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-narrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Soal</label>
                            <input type="text" name="soal" class="form-control @error('soal') is-invalid @enderror"
                                value="{{ old('soal', $soals->soal ?? '-') }}" placeholder="Masukan soal">
                            @error('soal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Gambar Soal</label><br>
                            @if ($soals->gambarsoal)
                                <img src="{{ asset('storage/' . $soals->gambarsoal) }}" alt="gambar"
                                    class="img-preview my-3" width="150">
                            @else
                                <img src="{{ asset('images/foto-profile.png') }}" alt="gambar" class="img-preview my-3"
                                    width="150">
                            @endif

                            <input type="file" name="gambarsoal" class="form-control" id="customFile"
                                onchange="previewImage()">
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
