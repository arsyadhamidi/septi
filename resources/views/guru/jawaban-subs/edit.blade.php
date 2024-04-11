@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            <form action="{{ route('guru-jawabansubs.updatejawabansubsoal', $jawabans->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('guru-jawabansubs.index', $jawabans->subsoal_id) }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-narrow-left"></i>
                            Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <input type="text" name="soal_id" class="form-control" value="{{ $jawabans->soal_id }}" hidden>
                        <input type="text" name="subsoal_id" class="form-control" value="{{ $jawabans->subsoal_id }}"
                            hidden>
                        <div class="mb-3">
                            <label>Jawaban Sub Soal</label>
                            <input type="text" name="jawabansubsoal"
                                class="form-control @error('jawabansubsoal') is-invalid @enderror"
                                value="{{ old('jawabansubsoal', $jawabans->jawabansubsoal) }}"
                                placeholder="Masukan jawaban sub soal">
                            @error('jawabansubsoal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nilai Sub Soal</label>
                            <input type="text" name="nilaijawabansubsoal"
                                class="form-control @error('nilaijawabansubsoal') is-invalid @enderror"
                                value="{{ old('nilaijawabansubsoal', $jawabans->nilaijawabansubsoal) }}"
                                placeholder="Masukan nilai jawaban sub soal">
                            @error('nilaijawabansubsoal')
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
