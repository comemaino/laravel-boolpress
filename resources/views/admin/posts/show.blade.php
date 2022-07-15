@extends('layouts.dashboard')

@section('content')
	<h1>{{ $post->title }}</h1>
	@if ($post->cover)
		<img src="{{ asset('storage/' . $post->cover) }}" alt="">
	@endif
	<p>{{ $post->slug }}</p>
	<p>{{ $post->created_at->format('d F Y - H:i') }}</p>
	{{-- <p>Modified: {{ $updated_mins_ago < 60 ? $updated_mins_ago : $post->updated_at->format('d F Y - H:i') }}</p> --}}
	<p>Category: <a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
	</p>
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
