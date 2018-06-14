@extends('layout.index')
@section('content')
<div class="container table-responsive">
  <div class="col-sm-4 push-sm-4">
    <h3 class="text-sm-center">Chi tiết đơn hàng</h3>
  </div>
  <table class="cart table table-striped">
  <thead>
    <tr>
      <th width="50%"><i class="icon_calendar"></i> Product</th>
      <th width="35%"><i class="icon_calendar"></i> Price</th>
      <th width="15%"><i class="icon_calendar"></i> Quantity</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($bill_detail as $bd)
      <tr>
        <td>{{$bd->linktoproduct->name}}</td>
         <td>{{$bd->price}}</td>
         <td>{{$bd->quantity}}</td>
      </tr>
    @endforeach
  </tbody>
</table>

 </div>

@endsection
