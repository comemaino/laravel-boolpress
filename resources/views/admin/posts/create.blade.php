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

	<form action="{{ route('admin.posts.store') }}" method="POST">
		@method('POST')
		@csrf

		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" name='title' class="form-control" id="title" value="{{ old('title') }}">
		</div>
		<div class="form-group">
			<label for="category">Category</label>
			<select name='category_id' class="form-control" id="category_id">
				<option value="">None</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="content">Content</label>
			<textarea type="text" name='content' class="form-control" id="content">
				{{ old('content') }}
      </textarea>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
@endsection
