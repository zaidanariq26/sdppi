@extends('layouts/main')

@section('container')
	<article>
		<h2>{{ $post['divisi'] }}</h2>
		<h6>{{ $post['body'] }}</h6>
	</article>
@endsection
