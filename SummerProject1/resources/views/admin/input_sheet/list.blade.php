@extends('admin.layout.index')
@section('maincontent')
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-table"></i> Danh sách phiếu nhập</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="fa fa-table"></i>Phiếu nhập</li>
        <li><i class="fa fa-th-list"></i>Danh sách</li>
      </ol>
    </div>
  </div>
          <!-- page start-->

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      <header class="panel-heading">
                          @if (session('notify'))
                            {{session('notify')}}
                          @endif
                      </header>

                      <table class="table table-striped table-advance table-hover">
                       <tbody>
                          <tr>
                             <th><i class="icon_profile"></i> ID</th>
                             <th><i class="icon_calendar"></i> Tên sản phẩm</th>
                             <th><i class="icon_cogs"></i>Giá</th>
                             <th><i class="icon_cogs"></i> Số lượng</th>
                             <th><i class="icon_cogs"></i> Tổng</th>
                             <th><i class="icon_cogs"></i> Nhà cung cấp</th>
                             <th><i class="icon_cogs"></i> Ngày nhập</th>
                             <th><i class="icon_cogs"></i> Người nhập</th>

                          </tr>
                          @foreach ($input_sheet as $i)
                            <tr>
                               <td>{{$i->id}}</td>
                               <td>{{$i->linktoinputdetail->product }}</td>
                               <td>{{$i->linktoinputdetail->price}}</td>
                               <td>{{$i->linktoinputdetail->quantity}}</td>
                               <td>{{$i->total}}</td>
                               <td>{{$i->linktoprovider->name}}</td>
                               <td>{{$i->input_date}}</td>
                               <td>{{$i->linktoadmin->name}}</td>
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
