@extends('admin.layout.index')
@section('maincontent')
  <!--main content start-->
  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-table"></i> Danh sách</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="fa fa-table"></i>Người dùng</li>
        <li><i class="fa fa-th-list"></i>Danh sách</li>
      </ol>
    </div>
  </div>
          <!-- page start-->

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      <header class="panel-heading">
                          @if (count($errors)>0)
                            @foreach ($errors->all() as $e)
                              {{$e}}<br/>
                            @endforeach
                          @endif
                          @if (session('notify'))
                            {{session('notify')}}
                          @endif
                      </header>
                      <table class="table table-striped table-advance table-hover">
                       <tbody>
                          <tr>
                             <th><i class="icon_profile"></i> ID</th>
                             <th><i class="icon_calendar"></i> Avatar</th>
                             <th><i class="icon_cogs"></i> Họ tên</th>
                             <th><i class="icon_cogs"></i> Tên hiển thị</th>
                             <th><i class="icon_cogs"></i> Email </th>
                             <th><i class="icon_cogs"></i> SĐT </th>
                             <th><i class="icon_cogs"></i> Address</th>
                             <th><i class="icon_cogs"></i> Action</th>
                          </tr>
                          @foreach ($user as $u)
                            <tr>
                               <td>{{$u->id}}</td>
                               <td>
                                 <img style="width:50px;height:50px" src="upload/users/{{$u->image}}" alt="">
                               </td>
                               <td>{{$u->name}}</td>
                               <td>{{$u->displayname}}</td>
                               <td>{{$u->email}}</td>
                               <td>{{$u->phone_number}}</td>
                               <td>{{$u->address}}</td>
                               <td>
                                <div class="btn-group">
                                    {{-- <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a> --}}
                                    <a class="btn btn-success" href="admin/user/edit/{{$u->id}}"><i class="icon_check_alt2"></i></a>
                                    <a onclick="return confirm('Bạn có chắc chắn không?')" class="btn btn-danger" href="admin/user/delete/{{$u->id}}"><i class="icon_close_alt2"></i></a>
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
