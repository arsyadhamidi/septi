@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-jurusan.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-jurusan.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-narrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Kode Jurusan</label>
                                    <input type="text" name="kodejurusan"
                                        class="form-control @error('kodejurusan') is-invalid @enderror"
                                        placeholder="Masukan kode jurusan" value="{{ old('kodejurusan') }}">
                                    @error('kodejurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="mb-3">
                                    <label>Nama Jurusan</label>
                                    <input type="text" name="namajurusan"
                                        class="form-control @error('namajurusan') is-invalid @enderror"
                                        placeholder="Masukan nama jurusan" value="{{ old('namajurusan') }}">
                                    @error('namajurusan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi Jurusan (optional)</label>
                            <textarea name="deskripsijurusan" class="form-control @error('deskripsijurusan') is-invalid @enderror" id="editor">{{ old('deskripsijurusan') }}</textarea>
                            @error('deskripsijurusan')
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
