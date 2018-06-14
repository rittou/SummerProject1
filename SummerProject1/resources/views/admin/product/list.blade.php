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
        <li><i class="fa fa-table"></i>Sản phẩm</li>
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
                             <th><i class="icon_cogs"></i> Hình ảnh</th>
                             <th><i class="icon_mail_alt"></i> Loại</th>
                             <th><i class="icon_cogs"></i> Hãng</th>
                             <th><i class="icon_cogs"></i> Mô tả</th>
                             <th><i class="icon_cogs"></i> Giá gốc</th>
                             <th><i class="icon_cogs"></i> Giá sale</th>
                             <th><i class="icon_cogs"></i> Số lượng</th>
                             <th><i class="icon_cogs"></i> Action</th>
                          </tr>
                          @foreach ($product as $p)
                            <tr @if ($p->status == 0)
                              {{ 'hidden' }}
                            @endif >
                               <td>{{$p->id}}</td>
                               <td>{{$p->name}}</td>
                               <?php
                               $data = $p->linktoimage->take(10);
                              //  $image1 = $data->shift();
                                ?>
                                <td>
                                @foreach ($data->all() as $d)
                                    <img style="width:100px;height:100px" src="upload/product/{{$d->image}}" alt="{{$d->image}}">
                                @endforeach
                                </td>
                               <td>{{$p->linktotype->name}}</td>
                               <td>{{$p->linktobrand->name}}</td>
                               <td>{{$p->description}}</td>
                               <td>{{$p->regular_price}}</td>
                               <td>{{$p->sale_price}}</td>
                               <td>{{$p->quantity}}</td>


                               <td>
                                <div class="btn-group">
                                    {{-- <a class="btn btn-primary" href="#"><i class="icon_plus_alt2"></i></a> --}}
                                    <a class="btn btn-success" href="admin/product/edit/{{$p->id}}"><i class="icon_check_alt2"></i></a>
                                    <a onclick="return confirm('Bạn có chắc chắn không?')" class="btn btn-danger" href="admin/product/delete/{{$p->id}}"><i class="icon_close_alt2"></i></a>
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
