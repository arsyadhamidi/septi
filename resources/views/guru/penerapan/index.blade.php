@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-lg">
            @foreach ($soals as $data)
                <div class="card">
                    <div class="card-header">
                        SOAL NOMOR {{ $loop->iteration }}
                    </div>
                    <div class="card-body">
                        @if ($data->gambarsoal)
                            <img src="{{ asset('storage/' . $data->gambarsoal) }}" class="img-fluid" width="150">
                        @endif
                        <p class="mt-5">{{ $data->soal ?? '-' }}</p>

                        @php
                            $jawabans = \App\Models\JawabanSoal::where('soal_id', $data->id)->get();
                        @endphp
                        <ol type="a">
                            @foreach ($jawabans as $jawaban)
                                <li class="{{ $jawaban->nilaijawabansoal == '1' ? 'text-danger' : '' }}">
                                    {{ $jawaban->jawabansoal ?? '-' }}
                                </li>
                            @endforeach
                        </ol>

                        @php
                            $subSoal = \App\Models\SubSoal::where('soal_id', $data->id)->get();
                        @endphp

                        @foreach ($subSoal as $val)
                            <p class="mt-3">{{ $loop->iteration }}. {{ $val->subsoal ?? '-' }}</p>

                            @php
                                $jawabanSubs = \App\Models\JawabanSubSoal::where('subsoal_id', $val->id)->get();
                            @endphp

                            <ol type="a">
                                @foreach ($jawabanSubs as $jawabansub)
                                    <li>
                                        {{ $jawabansub->jawabansubsoal ?? '-' }}
                                    </li>
                                @endforeach
                            </ol>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
