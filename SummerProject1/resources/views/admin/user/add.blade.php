@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Thêm mới người dùng</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="icon_document_alt"></i>Người dùng</li>
        <li><i class="fa fa-files-o"></i>Thêm</li>
      </ol>
    </div>
  </div>

          <div class="row">
              <div class="col-lg-12">
                  <section class="panel">

                        @if (count($errors)>0)
                          <header class="panel-heading">
                           @foreach ($errors->all() as $e)
                             {{$e}}<br/>
                           @endforeach
                           </header>
                       @endif
                       @if (session('notify'))
                         <header class="panel-heading">
                           {{session('notify')}}
                           </header>
                       @endif

                      <div class="panel-body">
                          <div class="form">
                              <form class="form-validate form-horizontal" enctype="multipart/form-data"  method="post" action="admin/user/add">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Họ tên <span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="name" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tên hiển thị<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="displayname" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Email<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="email" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Mật khẩu <span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="password" type="password" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Nhập lại mật khẩu<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="passwordAgain" type="password" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Số điện thoại<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="phone_number" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Địa chỉ hiện tại<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="address" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Avatar<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class="form-control" type="file" name="image">
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
