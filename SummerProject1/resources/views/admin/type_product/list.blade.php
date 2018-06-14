@extends('admin.layout.index')
@section('maincontent')
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-table"></i> Danh sách loại sản phẩm</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="fa fa-table"></i>Loại sản phẩm</li>
        <li><i class="fa fa-th-list"></i>Danh sách</li>
      </ol>
    </div>
  </div>
          <!-- page start-->

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">

                          @if (session('notify'))
                              <header class="panel-heading">
                            {{session('notify')}}
                            </header>
                          @endif


                      <table class="table table-striped table-advance table-hover">
                       <tbody>
                          <tr>
                             <th><i class="icon_profile"></i> ID</th>
                             <th><i class="icon_calendar"></i> Tên loại</th>
                             <th><i class="icon_mail_alt"></i> Hình ảnh</th>
                             <th><i class="icon_cogs"></i> Action</th>
                          </tr>
                          @foreach ($type_product as $tp)
                            <tr @if ($tp->status == 0)
                              {{ 'hidden' }}
                            @endif >
                               <td>{{$tp->id}}</td>
                               <td>{{$tp->name}}</td>
                               <td>
                                 <img style="width:13%" src="upload/product/{{$tp->image}}" alt="{{$tp->image}}">
                               </td>
                               <td>
                                <div class="btn-group">
                                    {{-- <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a> --}}
                                    <a class="btn btn-success" href="admin/type_product/edit/{{$tp->id}}"><i class="icon_check_alt2"></i></a>
                                    <a onclick="return confirm('Bạn có chắc chắn không?')" class="btn btn-danger" href="admin/type_product/delete/{{$tp->id}}"><i class="icon_close_alt2"></i></a>
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
