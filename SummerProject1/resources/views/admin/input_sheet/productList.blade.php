@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">
                      <div class="row">
                          <div class="col-lg-12">
                              <section class="panel">
                                  <header class="panel-heading">
                                      <p class="lead">
                                        {{ $provider->name }}'s products
                                      </p>
                                  </header>
                                    <table class="table table-striped table-advance table-hover">
                                     <tbody>
                                        <tr>
                                           <th><i class="icon_profile"></i> ID</th>
                                           <th><i class="icon_calendar"></i> Tên sản phẩm</th>
                                           <th><i class="icon_calendar"></i> Hình ảnh</th>
                                           <th><i class="icon_cogs"></i> Loại</th>
                                           <th><i class="icon_cogs"></i> Hãng</th>
                                           <th><i class="icon_cogs"></i> Giá </th>
                                           <th><i class="icon_cogs"></i> Số lượng hàng tồn </th>
                                           <th><i class="icon_cogs"></i> Action </th>
                                        </tr>
                                        @foreach ($product as $p)
                                          <tr
                                          @if ($p->status == 0)
                                          {{'hidden'}}
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
                                             <td>{{$p->regular_price}}</td>
                                             <td>{{$p->quantity}}</td>
                                             <td>
                                               <a class="btn btn-primary" href="admin/input_sheet/add/{{$p->id}}"><i class="icon_plus_alt2"></i></a>
                                             </td>
                                          </tr>
                                        @endforeach
                                     </tbody>
                                  </table>
                              </section>
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
