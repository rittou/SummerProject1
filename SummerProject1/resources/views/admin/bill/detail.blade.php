@extends('admin.layout.index')
@section('maincontent')
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header"><i class="fa fa-table"></i> Chi tiết hóa đơn</h3>
    <ol class="breadcrumb">
      <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
      <li><i class="fa fa-table"></i>Hóa đơn</li>
      <li><i class="fa fa-th-list"></i>Chi tiết</li>
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
                             <th><i class="icon_calendar"></i> Sản phẩm</th>
                             <th><i class="icon_calendar"></i> Giá</th>
                             <th><i class="icon_calendar"></i> Số lượng</th>
                          </tr>
                          @foreach ($bill_detail as $bd)
                            <tr>
                              <td>{{$bd->linktoproduct->name}}</td>
                               <td>{{$bd->price}}</td>
                               <td>{{$bd->quantity}}</td>
                            </tr>
                          @endforeach
                       </tbody>
                    </table>
                  </section>
              </div>
          </div>
          <!-- page end-->

@endsection
