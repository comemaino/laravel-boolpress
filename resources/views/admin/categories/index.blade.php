@extends('layouts.dashboard')

@section('content')
	<h1>Categories</h1>
	<div>
		<ul>
			@foreach ($categories as $category)
				<li>
					<a href="">{{ $category->name }}</a>
				</li>
			@endforeach
		</ul>
	</div>
@endsection
