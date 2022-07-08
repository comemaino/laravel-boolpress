@extends('layouts.dashboard')

@section('content')
	<h1>Categories</h1>
	<div>
		<ul>
			@foreach ($categories as $category)
				<li>
					<a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
				</li>
			@endforeach
		</ul>
	</div>
@endsection
