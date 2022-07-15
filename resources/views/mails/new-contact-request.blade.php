<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>
	<h1>Hi admin</h1>
	<p>you received a new request</p>

	<h3>{{ $lead->name }}</h3>
	<p>{{ $lead->email }}</p>
	{{ $lead->message }}
</body>

</html>
