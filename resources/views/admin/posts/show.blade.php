@extends('layouts.dashboard')

@section('content')
	<h1>{{ $post->title }}</h1>
	<p>{{ $post->slug }}</p>
	<p>Category: {{ $category ? $category->name : 'none' }}</p>
	<p>Tags:
		@forelse ($post->tags as $tag)
			{{ $tag->name }}{{ $loop->last ? '' : ', ' }}
		@empty
			none
		@endforelse
	</p>
	<p>{{ $post->content }}</p>

	<a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>
	<form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-danger mt-3"
			onclick="confirm('Do you really want to delete this post?')">Delete</button>
	</form>
@endsection
