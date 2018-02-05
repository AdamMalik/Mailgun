<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<ul>
	@foreach($all as $item)
		<li>
			<p>{{$item}}</p>
		</li>
	@endforeach
	</ul>

	<form action="/coba" method="post">
		<input type="text" name="username" placeholder="username"><br>
		<input type="text" value="{{csrf_token()}}" hidden>
		<input type="submit">
	</form>
</body>
</html>