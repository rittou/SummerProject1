<!DOCTYPE html>
<html lang="en"><head>
	<title> Rittou Shop - Mail xác nhận đơn hàng </title>
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
	<p class="lead">
		Kính chào quý khách {{$orderBill->name}}
	</p>
	<p>Rittou Shop đã nhận được đơn hàng của quý khách đặt ngày {{$orderBill->order_date}} với hình thức thanh toán là {{$orderPayment}}</p>
	<p>Sau đây là chi tiết đơn hàng:</p>

		<?php
			$bill_detail = DB::table('bill_detail')->where('id_bill',$orderBill->id)->get();
		 ?>
		 @foreach ($bill_detail as $bd)
			 <?php
			 	$id = $bd->id_product;
				$product= DB::table('product')->where('id', $id)->get();
			  ?>
				@foreach ($product as $p )
					<div style="margin-left:15px; margin-bottom:15px">
					<p>Tên sản phẩm: {{$p->name}}</p>
					<p>Số lượng: {{$bd->quantity}}</p>
			    <p>Giá: {{$bd->price}}</p>
					</div>
				@endforeach


	 @endforeach
    <p>Thành tiền: {{$orderBill->total}}</p>
    <p>Đơn hàng sẽ được chuyển đến:</p>
    <p>{{$orderBill->name}} có sđt {{$orderBill->phone_number}} tại {{$orderBill->order_address}}</p>
</body>
</html>
