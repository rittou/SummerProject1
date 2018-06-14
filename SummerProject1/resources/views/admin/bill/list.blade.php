@extends('admin.layout.index')
@section('maincontent')
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-table"></i> Danh sách hóa đơn </h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="fa fa-table"></i>Bill</li>
        <li><i class="fa fa-th-list"></i>List</li>
      </ol>
    </div>
  </div>
          <!-- page start-->

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      {{-- <header class="panel-heading">
                          @if (count($errors)>0)
                            @foreach ($errors->all() as $e)
                              {{$e}}<br/>
                            @endforeach
                          @endif
                          @if (session('notify'))
                            {{session('notify')}}
                          @endif
                      </header> --}}
                      <table class="table table-striped table-advance table-hover">
                       <tbody>
                          <tr>
                             <th><i class="icon_profile"></i> ID</th>
                             <th><i class="icon_calendar"></i> Tên</th>
                             <th><i class="icon_calendar"></i> Email</th>
                             <th><i class="icon_calendar"></i> Địa chỉ đặt hàng</th>
                             <th><i class="icon_calendar"></i> Số điện thọa</th>
                             <th><i class="icon_calendar"></i> Ngày đặt hàng</th>
                             <th><i class="icon_calendar"></i> Tổng tiền</th>
                             <th><i class="icon_calendar"></i> Hình thức thanh toán</th>
                             <th><i class="icon_calendar"></i> Trạng thái</th>
                             <th><i class="icon_cogs"></i> </th>
                          </tr>
                          @foreach ($bill as $b)
                            <tr>
                               <td>{{$b->id}}</td>
                               <td>{{$b->name}}</td>
                               <td>{{$b->email}}</td>
                               <td>{{$b->order_address}}</td>
                               <td>{{$b->phone_number}}</td>
                               <td>{{$b->order_date}}</td>
                               <td>{{$b->total}}</td>
                               <td>{{$b->linktopayment->name}}</td>
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
                                  <div @if($b->status == 0)
                                       {{'hidden'}}
                                     @endif><a class="btn btn-primary" href="admin/bill/edit/{{$b->id}}"><i class="icon_plus_alt2"></i></a></div>
                                  <div><a class="btn btn-success" href="admin/bill/detail/{{$b->id}}"><i class="fa fa-eye"></i></a></div>
                                </div>
                                </td>
                            </tr>
                          @endforeach
                       </tbody>
                    </table>
                  </section>
              </div>
          </div>
          <!-- page end-->
      </section>
  </section>
@endsection
