@extends('layout.index')
@section('content')
   <div class="container">
     <div class="row">
       <div class="col-sm-8 pb-3">
         <p class="lead">
           Thông tin giao hàng của khách hàng
         </p>
         @if (count($errors)>0)
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
           @endif
         <hr>
         @if (Auth::check())
           <div class="use">
             <form class="form-validate form-horizontal" action="shipping" method="post">
               <input type="hidden" name="_token" value="{{csrf_token('')}}">
               <p>Email: {{Auth::user()->email}}</p>
               <p>Tên: {{Auth::user()->name}}</p>
               <p>Địa chỉ: {{Auth::user()->address}}</p>
               <p>SĐT liên lạc: {{Auth::user()->phone_number}}</p>
               <input type="checkbox" class="" name="changeAddress" id="changeAddress">
               <label>Đổi địa chỉ giao hàng</label>
               <input type="text" name="order_address" class="form-control address" placeholder="Quý khách có thể đổi địa chỉ giao hàng ở đây" disabled>
           </div>

         @else
       <form class="form-validate form-horizontal" action="shipping" method="post">
         <input type="hidden" name="_token" value="{{csrf_token('')}}">
           <div class="form-group">
             <label>Email</label>
             <input type="text" class="form-control" name="email" value="" placeholder="Vui lòng nhập email">
           </div>
           <div class="form-group">
             <label>Tên</label>
             <input type="text" class="form-control" name="name" value="" placeholder="Họ và tên">
           </div>
           <div class="form-group">
             <label>Địa chỉ giao hàng</label>
             <input type="text" class="form-control" name="order_address" value="" placeholder="Ví dụ: Phổ Phong - Đức Phổ - Quảng Ngãi">
           </div>
           <div class="form-group">
             <label>SĐT liên lạc</label>
             <input type="text" class="form-control" name="phone_number" value="" placeholder="Số điện thoại">
           </div>

        @endif

          Hình thức thanh toán <select class="form-control" name="id_payment">
          @foreach ($payment as $pm)
            <option value="{{ $pm->id }}">{{$pm->name}}</option>
          @endforeach
        </select>
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
                    <td class="text-xs-center">{{number_format($c->price)}}</td>
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
              <strong class="text-sm-right">{{$total}}</strong>
            </div>
          </div>
          <div class="action text-xs-center ml-3 mt-3">
            <button type="submit" class="btn btn-primary">Thanh toán</button>
          </div>
        </div>
      </div>

      </form>
   </div>

@endsection
