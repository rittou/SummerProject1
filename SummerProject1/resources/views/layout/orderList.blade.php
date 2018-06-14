

<?php
    $bill = DB::table('bill')->where('id_users',Auth::user()->id)->get();
 ?>


@extends('layout.index')
@section('content')



   <div class="container table-responsive">
    <div class="col-sm-4 push-sm-4">
      <h3 class="text-sm-center">Chi tiết đơn hàng</h3>
    </div>
    <table class="cart table table-striped">
    <thead>
      <tr>
        <th>Id</th>
        <th >Họ tên người đặt </th>
        <th>Địa chỉ đặt hàng</th>
        <th >Số điện thoại</th>
        <th >Ngày đặt</th>
        <th >Phương thức thanh toán</th>
        <th>Tình trạng đơn hàng</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <form class="" action="" method="get">
        <input type="hidden" name="_token" value="{{csrf_token('')}}">
        @foreach ($bill as $b)
        <tr>
           <td>{{$b->id}}</td>
           <td>{{$b->name}}</td>
           <!-- <td>{{$b->email}}</td> -->
           <td>{{$b->order_address}}</td>
           <td>{{$b->phone_number}}</td>
           <td>{{$b->order_date}}</td>
           <!-- <td>{{$b->total}}</td> -->
           <?php
              $payment = DB::table('payment')->where('id', $b->id_payment)->get();
            ?>
            @foreach($payment as $p)
             <td>{{$p->name}}</td>
            @endforeach
           <td><?php if ($b->status == 1) {
             echo "Đang xử lý";
             }
             else if ($b->status == 2) {
               echo "Đang giao hàng";
             }
             else if ($b->status == 3) {
               echo "Đã giao hàng";
             }
             else {
               echo "Đã hủy";
             }
            ?></td>
           <td>
            <div class="btn-group">
                <a onclick="return confirm('Bạn có chắc chắn không?')" class="btn btn-danger orderCancel" id="{{$b->id}}"
                 @if($b->status != 1)
                 {{'hidden'}}
                 @endif
                  ><i class="fa fa-times"></i></a>
                <a class="btn btn-success" href="orderListDetail/{{$b->id}}"><i class="fa fa-eye"></i></a>
            </div>
            </td>
        </tr>
        @endforeach
        </form>
    </tbody>
  </table>

   </div>

@endsection
