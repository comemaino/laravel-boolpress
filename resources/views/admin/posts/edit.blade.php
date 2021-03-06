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

	<form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf

		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name='title'
				value="{{ old('title') ? old('title') : $post->title }}">
		</div>

		<div class="form-group">
			<label for="category_id">Category</label>
			<select class="form-control" name="category_id" id="category_id">
				<option value="">None</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}"
						{{ $post->category && old('category_id', $post->category->id) == $category->id ? 'selected' : '' }}>
						{{ $category->name }} </option>
				@endforeach
			</select>
		</div>

		<div>
			<h4>Tags</h4>
			@foreach ($tags as $tag)
				<div>
					<input type="checkbox" class="form-check-input" name="tags[]" value="{{ $tag->id }}"
						id="tag-{{ $tag->id }}"
						{{ $post->tags->contains($tag) || in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
					<label for="tag-{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
				</div>
			@endforeach
		</div>

		<div class="form-group">
			<label for="content">Content</label>
			<textarea type="text" name='content' class="form-control" id="content" rows="10">
				{{ old('content') ? old('content') : $post->content }} </textarea>
		</div>

		<div>
			<label for="image">Cover</label>
			<input type="file" name="image" id="image">
			@if ($post->cover)
				<img src="{{ asset('storage/' . $post->cover) }}" alt="">
			@endif

		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

@endsection
