<!DOCTYPE html>
<html lang="en"><head>
	<title> Rittou Shop - Thiên đường cho phượt thủ </title>
  <base href="{{asset('')}}" >
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="js/1.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&amp;subset=vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="vendor/bootstrap.css">
	<link rel="stylesheet" href="vendor/font-awesome.css">
 	<link rel="stylesheet" href="css/1.css">
</head>
<body >

		@include('layout.menu')

		@include('layout.slide')

	 	@include('layout.sub')

		@yield('content')

		@include('layout.contact')

	 @include('layout.social')



</body>
</html>
