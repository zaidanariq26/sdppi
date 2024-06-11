@extends('layouts.main')

@section('container')
    <h1>ini halaman about</h1>
    <h3>{{ $name }}</h3>
    <h3>{{ $email }}</h3>
    {{-- <img src="img/{{ $image }}" alt="{{ $name }}"> --}}
@endsection