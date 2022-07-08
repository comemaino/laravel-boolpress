@extends('layouts.dashboard')

@section('content')
	<h1>{{ $category->name }}</h1>

	<ul>
		@foreach ($posts->where('category', $category) as $post)
			<li>
				<a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
			</li>
		@endforeach
	</ul>
@endsection
