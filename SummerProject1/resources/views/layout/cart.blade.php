@extends('layout.index')
@section('content')
  @if (session('notify'))
    <div class="text-xs-center">
      <button type="button" class="btn btn-lg btn-warning">
        {{ session('notify') }}
      </button>
    </div>
  @endif
  @if (Cart::count() > 0)
   <div class="container table-responsive">
    <table class="cart table table-striped">
    <thead>
      <tr>
        <th style="width:5%">#</th>
        <th style="width:50%">Sản phẩm</th>
        <th style="width:7%">Giá</th>
        <th style="width:10%">Số lượng</th>
        <th style="width:15%">Thành tiền</th>
        <th style="width:10%">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i=1;
      ?>
      <form class="" action="" method="get">
        <input type="hidden" name="_token" value="{{csrf_token('')}}">
        @foreach ($content as $c)
          <tr>
            <th class="stt" scope="row">{{ $i }}</th>
            <td>
              <div class="row">
                <div class="col-sm-4">
                  <img style="width:50%" src="upload/product/{{$c->options->image}}" alt="">
                </div>
                <div class="col-sm-8">
                  {{ $c->name }}
                </div>
              </div>
            </td>
            <td>{{ number_format($c->price)  }}</td>
            <td ><input class="form-control text-center qty" id="qty" name="qty" value="{{ $c->qty }}" type="number"></td>
            <td>{{ number_format($c->price * $c->qty)   }}</td>
            <td>
              <div class="row">
                <div class="col-sm-3">
                  <a class="updateCart" id="{{$c->rowId}}">
                    <button class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i></button>
                  </a>
                </div>
                <div class="col-sm-3">
                  <a class="removefromCart" id="{{$c->rowId}}">
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                  </a>
                </div>
              </div>
             </td>
          </tr>
          <?php $i++; ?>
        @endforeach
      </form>
    </tbody>
  </table>
        <p class="lead text-sm-right">Tổng cộng: {{$total}}</p>

   </div>
  <div class="action text-sm-right">
    <a href="homepage"><button type="button" class="btn btn-primary">Tiếp tục mua hàng</button></a>
    <a href="order"><button type="button" class="btn btn-primary">Đặt hàng</button></a>
  </div>
  @endif
  @if(Cart::count() == 0)
  <div class="action text-xs-center pb-1">
    <a href="homepage"><img src="images/empty-cart.png" alt="empty cart"></a>
  </div>
  <div class="text-xs-center pb-3">
    <a href="homepage"><button type="button" class="btn btn-primary">Quay lại mua hàng</button></a>
  </div>
  @endif
@endsection
