@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Sửa thương hiệu</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="icon_document_alt"></i>Thương hiệu</li>
        <li><i class="fa fa-files-o"></i>Sửa</li>
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
                              <form class="form-validate form-horizontal"  method="post" action="admin/brand/edit/{{$brand->id}}">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tên hãng<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="name" type="text" value="{{$brand->name}}"/>
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
