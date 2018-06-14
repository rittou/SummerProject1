@extends('admin.layout.index')
@section('maincontent')
<?php echo $bill; ?>
  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Sửa hóa đơn</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="icon_document_alt"></i>Hóa đơn</li>
        <li><i class="fa fa-files-o"></i>Sửa</li>
      </ol>
    </div>
  </div>

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      <header class="panel-heading">
                       @if (session('notify'))
                           {{session('notify')}}
                       @endif
                      </header>
                      <div class="panel-body">
                          <div class="form">
                              <form class="form-validate form-horizontal"  method="post" action="admin/bill/edit/{{$bill->id}}">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tên người đặt hàng<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="name" type="text" value="{{$bill->name}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Địa chỉ đặt hàng<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="order_adress" name="order_adress" type="text" value="{{$bill->order_address}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Email<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="email" name="email" type="text" value="{{$bill->email}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Số điện thoại<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="phone_number" name="phone_number" type="text" value="{{$bill->phone_number}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Ngày đặt hàng<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="order_date" name="order_date" type="text" value="{{$bill->order_date}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tổng tiền<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="total" name="total" type="text" value="{{$bill->total}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Hình thức thanh toán<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="id_payment" name="id_payment" type="text" value="{{$payment->name}}" disabled/>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tình trạng đơn hàng<span class="required">*</span></label>
                                      <label class="radio-inline">
                                        <input type="radio" name="status" value="1">Đang xử lý
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="status" value="2">Đang giao hàng
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="status" value="3">Đã giao hàng
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="status" value="0">Đã hủy
                                      </label>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                          <button class="btn btn-primary" type="submit">Lưu</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </section>
              </div>
          </div>
          <!-- page end-->
      </section>
  </section>

  <!--main content end-->

@endsection
