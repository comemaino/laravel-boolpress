@extends('layouts.dashboard')

@section('content')
	<h1>Your Posts</h1>
	<div class="row row-cols-3">

		@foreach ($posts as $post)
			<div class="card" style="width: 18rem;">
				<div class="card-body">
					<h5 class="card-title">{{ $post->title }}</h5>
					{{-- <p>{{ dd($post->category) }}<a href="">{{ $post->category['name'] }}</a> --}}
					@if ($post->cover)
						<img class="card-img-top" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
					@endif
					</p>
					<p class="card-text">{{ Str::limit($post->content, 100) }}
					</p>
					<a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="card-link">Read Post</a>

				</div>
			</div>
		@endforeach

	</div>
@endsection
