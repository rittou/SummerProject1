@extends('layout.index')
@section('content')
   <div class="container">
     <div class="row mb-2">
       <div class="col-sm-8 pb-3">
         <p class="lead">
           Thanh toán qua cổng PayPal
         </p>
         <!-- @if (count($errors)>0)
             <div class="alert alert-danger">
               @foreach ($errors->all() as $e)
                 {{$e}}<br/>
               @endforeach
             </div>
           @endif
           @if (session('notify'))
             <div class="alert alert-warning">
               {{session('notify')}}
             </div>
           @endif -->
        <?php $currency = floatval($total);
        $currency = $currency/22000;
       ?>
         <hr>
           <div class="use">
             <form class="form-validate form-horizontal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
               <input type="hidden" name="_token" value="{{csrf_token('')}}">
               <input type="hidden" name="business" value="nhlp2510-facilitator@gmail.com">
               <input type="hidden" name="cmd" value="_xclick">
               <input type="hidden" name="item_name" value="HoaDonMuaHang">
               <label>Số tiền hóa đơn(USD) :</label>
               <input type="number" class="form-control" name="amount" value="{{(round($currency,2))}}" >
               <input type="hidden" name="currency_code" value="USD">
               <input type="hidden" name="return" value="{{route('order_complete')}}">
               <input type="hidden" name="cancel_return" value="{{route('order_fail',['$id'=>$id])}}">
               <input type="submit" class="form-control mt-2" name="submit" value="Thanh toán qua Paypal">
           </div>
        </div>

        <div class="col-sm-4">
            <p class="lead text-sm-center">
              Thông tin đơn hàng
            </p>
            <div class="container table table-responsive">
              <table>
              <thead>
                <tr>
                  <td class="text-xs-center">Sản phẩm</td>
                  <td class="text-xs-center">Số lượng</td>
                  <td class="text-xs-center">Giá</td>
                </tr>
              </thead>
              <tbody>
                @foreach ($content as $c)
                  <tr>
                    <td class="text-xs-center">{{$c->name}}</td>
                    <td class="text-xs-center">{{$c->qty}}</td>
                    <td class="text-xs-center">{{number_format($c->price)}} VNĐ</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <hr>
          </div>
          <div class="row">
            <div class="col-sm-6 text-xs-left">
              <strong>Tổng tiền:</strong>
            </div>
            <div class="col-sm-6 text-sm-right">
              <strong class="text-sm-right">{{$total}} VNĐ</strong>
            </div>
          </div>
        </div>
      </div>
      </form>
   </div>

@endsection
