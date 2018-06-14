<!DOCTYPE html>
<html lang="en"><head>
	<title> Example </title>
  <base href="{{asset('')}}">
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
		  <div class="row">
				@if (count($errors)>0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $e)
						{{$e}}<br/>
					@endforeach
				</div>
			@endif
			@if (session('notify'))
				<div class="alert alert-success">
					{{session('notify')}}
				</div>
			@endif
		    <div class="col-sm-6 push-sm-3">
		    	<h3 class="text-sm-center">Tạo tài khoản</h3>
					<form class="" action="admin/account" enctype="multipart/form-data" method="post">
								<input type="hidden" name="_token" value="{{csrf_token('')}}">
								<input type="text" name="name" class="form-control" placeholder="Họ tên đầy đủ">
								<input type="text" name="displayname" class="form-control" placeholder="Tên hiển thị">
						    <input type="email" name="email" class="form-control" placeholder="Email">
						    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
						    <input type="password" name="passwordAgain" class="form-control" placeholder="Nhập lại mật khẩu">
						    <input type="text" name="phone_number" class="form-control" placeholder="Số điện thọai">
						    <input type="text" name="address" class="form-control" placeholder="Địa chỉ hiện tại">
								Avatar <input class="form-control" type="file" name="image">
								<div class="row">
									<div class="col-sm-4">
										<p class="text-sm-left"><button type="submit" class="btn btn-sm btn-outline-secondary">Đăng ký</button></p>
									</div>
									<div class="col-sm-8">
										<p class="text-sm-right"><small>Already a member ? <a href="login">Log in</a></small></p>
									</div>
								</div>


					</form>

		    </div>
		  </div>
		</div>


</body>
</html>
