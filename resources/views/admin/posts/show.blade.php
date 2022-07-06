@extends('layouts.dashboard')

@section('content')
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->slug }}</p>
	<p>{{ $post->content }}</p>

	<a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>
@endsection
