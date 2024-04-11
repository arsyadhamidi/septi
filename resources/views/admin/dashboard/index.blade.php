@extends('admin.layout.master')

@section('content')
    @if (Auth()->user()->level == 'Admin')
    @elseif (Auth()->user()->level == 'Guru')

    @elseif (Auth()->user()->level == 'Siswa')
    @endif
@endsection
