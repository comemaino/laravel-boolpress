@extends('layouts.dashboard')

@section('content')
	<h1>{{ $category->name }}</h1>

	<div class="row row-cols-3">
		@foreach ($posts->where('category', $category) as $post)
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">{{ $post->title }}</h5>
					<p><a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
					</p>
					<p class="card-text">{{ Str::limit($post->content, 100) }}
					</p>
					<a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="card-link">Read Post</a>

				</div>
			</div>
			{{-- <li>
				<a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
			</li> --}}
		@endforeach
	</div>
@endsection
