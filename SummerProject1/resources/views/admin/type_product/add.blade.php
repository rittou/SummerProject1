@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Thêm loại sản phẩm</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="icon_document_alt"></i>Loại sản phẩm</li>
        <li><i class="fa fa-files-o"></i>Thêm</li>
      </ol>
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
                              <form class="form-validate form-horizontal" enctype="multipart/form-data"  method="post" action="admin/type_product/add">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tên loại<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="name" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label for="image" class=" control-label col-lg-2">Hình ảnh <span class="required">*</span></label>
                                      <div class="col-lg-10 ">
                                          <input class="btn btn-secondary form-control" type="file" name="image">
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
