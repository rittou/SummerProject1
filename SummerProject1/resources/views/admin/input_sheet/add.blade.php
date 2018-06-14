@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Thêm phiếu nhập</h3>
    </div>
  </div>

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
                      <div class="panel-body">
                          <div class="form">
                            <form class="form-validate form-horizontal"  method="post" action="admin/input_sheet/add/{{$product->id}}">
                              <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Tên sản phẩm<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <p>{{$product->name}}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Loại<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <p>{{$product->linktotype->name}}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Hãng<span class="required">*</span></label>
                                    <div class="col-lg-10">
                                        <p>{{$product->linktobrand->name}}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Giá bán</label>
                                    <div class="col-lg-10">
                                        <p>{{ $product->regular_price }}</p>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Giá nhập</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" id="name" name="price" type="number" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Số lượng nhập</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" id="name" name="quantity" type="number" />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-lg-2">Ngày nhập</label>
                                    <div class="col-lg-10">
                                        <input class=" form-control" id="name" name="input_date" type="date" />
                                    </div>
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
