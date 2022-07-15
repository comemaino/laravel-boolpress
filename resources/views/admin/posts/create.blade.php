@extends('layouts.dashboard')

@section('content')
	<h1>Create a new post</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
		@method('POST')
		@csrf

		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" name='title' class="form-control" id="title" value="{{ old('title') }}">
		</div>

		<div class="form-group">
			<label for="category_id">Category</label>
			<select class="form-control" name="category_id" id="category_id">
				<option value="">None</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
						{{ $category->name }}</option>
				@endforeach
			</select>
		</div>

		<h5>Tags</h5>
		@foreach ($tags as $tag)
			<div class="form-check">
				<input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }}"
					id="tag-{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
				<label class="form-check-label" for="tag-{{ $tag->id }}">
					{{ $tag->name }}
				</label>
			</div>
		@endforeach

		<div class="form-group">
			<label for="content">Content</label>
			<textarea type="text" name='content' class="form-control" id="content">
				{{ old('content') }}
      </textarea>
		</div>

		<div>
			<label for="image">Cover image</label>
			<input type="file" id="image" name="image">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection
