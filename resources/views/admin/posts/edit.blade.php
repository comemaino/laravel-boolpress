@extends('layouts.dashboard')

@section('content')
	<h1>Edit your post</h1>

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
			<input type="text" name='title' class="form-control" id="title"
				value="{{ old('title') ? old('title') : $post->title }}">
		</div>
		<div class="form-group">
			<label for="content">Content</label>
			<textarea type="text" name='content' class="form-control" id="content" rows="10">
				{{ old('content') ? old('content') : $post->content }} </textarea>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

@endsection
