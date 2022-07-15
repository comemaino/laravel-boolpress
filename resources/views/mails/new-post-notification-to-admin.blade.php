<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Mail</title>
</head>

<body>
	<h1>Un nuovo post è stato creato</h1>
	{{ $new_post->title }}
	<a href="{{ route() }}"></a>
</body>

</html>
