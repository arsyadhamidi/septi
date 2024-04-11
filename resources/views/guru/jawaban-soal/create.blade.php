@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('guru-soal.storejawaban') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('guru-soal.show', $soals->id) }}" class="btn btn-info">
                            <i class="ti ti-arrow-narrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <input type="text" name="soal_id" class="form-control" value="{{ $soals->id }}" hidden>
                        <div class="mb-3">
                            <label>Jawaban</label>
                            <input type="text" name="jawabansoal"
                                class="form-control @error('jawabansoal') is-invalid @enderror"
                                value="{{ old('jawabansoal') }}" placeholder="Masukan jawaban">
                            @error('jawabansoal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nilai</label>
                            <input type="text" name="nilaijawabansoal"
                                class="form-control @error('nilaijawabansoal') is-invalid @enderror"
                                value="{{ old('nilaijawabansoal') }}" placeholder="Masukan nilai jawaban">
                            @error('nilaijawabansoal')
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
