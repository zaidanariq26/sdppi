@extends('layouts/main')

@section('container')
	<article>
		@foreach ($posts as $post)
			<h2><a href="/posts/{{ $post['slug'] }}">{{ $post['divisi'] }}</a></h2>
			<h6>{{ $post['body'] }}</h6>
		@endforeach
	</article>
@endsection
