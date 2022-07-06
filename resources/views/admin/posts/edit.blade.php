@extends('layouts.dashboard')

@section('content')
	<h1>pagina create</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
		@method('PUT')
		@csrf

		<div class="form-group">
			<label for="title">Title</label>
			<input type="title" class="form-control" id="title" aria-describedby="title" placeholder="Title"
				value="{{ $post->title }}">
		</div>
		<div class="form-group">
			<label for="title">Content</label>
			<textarea type="content" class="form-control" id="content" rows='10' aria-describedby="content"
			 placeholder="Your content here">
				{{ $post->content }}
      </textarea>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

@endsection
