<!DOCTYPE html>
<html lang="en"><head>
	<title> Rittou Shop - Trang thông tin cá nhân </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="vendor/bootstrap.js"></script>
 	<script type="text/javascript" src="js/1.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700&amp;subset=vietnamese" rel="stylesheet">
	<link rel="stylesheet" href="vendor/bootstrap.css">
	<link rel="stylesheet" href="vendor/font-awesome.css">
 	<link rel="stylesheet" href="css/1.css">
</head>
<body class="wrapper2">
		<div class="container">
			@if (count($errors)>0)
			<div class="text-xs-center alert alert-danger">
				@foreach ($errors->all() as $e)
					{{$e}}<br/>
				@endforeach
			</div>
		@endif
		@if (session('notify'))
			<div class="text-xs-center alert alert-success">
				{{session('notify')}}
				<a href="homepage">Back to Homepage</a>
			</div>
		@endif
		  <div class="row">
		    <div class="col-sm-4 push-sm-4">
		    	<h3 class="text-sm-center">Profile</h3>
					<form class="" action="profile" method="post" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{csrf_token('')}}">
								<img class="profile" style="width:100%" src="upload/users/{{Auth::user()->image}}" alt="{{Auth::user()->image}}">
								<input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
								<input type="text" name="displayname" class="form-control" value="{{Auth::user()->displayname}}">
						    <input type="email" disabled name="email" class="form-control" value="{{Auth::user()->email}}">
            		<input type="checkbox" class="" name="changePassword" id="changePassword">
              	<label>Đổi mật khẩu</label>
              	<input type="password" name="password" class="form-control password" placeholder="Password" disabled>
								<input type="password" name="passwordAgain" class="form-control password" placeholder="Password Again" disabled>
								<input type="text" name="phone_number" class="form-control" value="{{Auth::user()->phone_number}}">
								<input type="text" name="address" class="form-control" value="{{Auth::user()->address}}">
								<p class="text-sm-center"><button type="submit" class="btn btn-sm btn-outline-secondary">Submit</button></p>
					</form>
					<hr/>
					<p class="text-sm-center"><small>Already a member ? <a href="login">Log in</a></small></p>
		    </div>
		  </div>
		</div>


</body>
</html>
