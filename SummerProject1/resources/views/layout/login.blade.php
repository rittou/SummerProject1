<!DOCTYPE html>
<html lang="en"><head>
	<title> Rittou Shop - Login </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="js/1.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&amp;subset=vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="vendor/bootstrap.css">
	<link rel="stylesheet" href="vendor/font-awesome.css">
 	<link rel="stylesheet" href="css/1.css">
</head>
<body  class="wrapper1">
		<div class="container">
			@if (count($errors)>0)
					<div class="alert alert-danger text-xs-center">
						@foreach ($errors->all() as $e)
							{{$e}}<br/>
						@endforeach
					</div>
				@endif
				@if (session('notify'))
					<div class="alert alert-warning text-xs-center">
						{{session('notify')}}
					</div>
				@endif
		  <div class="row">
		    <div class="col-sm-4 push-sm-4">
		    	<h3 class="text-sm-center">Đăng nhập</h3>
					<form class="" action="login" method="post">
								<input type="hidden" name="_token" value="{{csrf_token('')}}">
						    <input type="text" name="email" class="form-control" placeholder="Email">
						    <input type="password" name="password" class="form-control" placeholder="Password">
								<button type="submit" class="btn btn-sm btn-outline-secondary">Login</button>
					</form>
					<hr/>
					<p class="text-sm-center"><small>New to site?<a href="signup">Create Account</a></small></p>
		    </div>
		  </div>
		</div>
</body>
</html>
