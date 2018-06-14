@extends('admin.layout.index')
@section('maincontent')

  <section id="main-content">
      <section class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><i class="fa fa-files-o"></i> Sửa sản phẩm</h3>
      <ol class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="admin/dashboard">Dashboard</a></li>
        <li><i class="icon_document_alt"></i>Sản phẩm</li>
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
                              <form class="form-validate form-horizontal" enctype="multipart/form-data"  method="post" action="admin/product/edit/{{$product->id}}">
                                <input type="hidden" name="_token" value="{{csrf_token('')}}">
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Tên sản phẩm<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="name" value="{{$product->name}}" type="text" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label for="image" class=" control-label col-lg-2">Hình ảnh <span class="required">*</span></label>
                                      <div class="col-lg-10">
                                        @foreach ($product->linktoimage as $image)
                                          <img style="width:10%" src="upload/product/{{$image->image}}" alt="{{$image->image}}">
                                        @endforeach
                                      </div>
                                      <div class="col-lg-10 col-lg-offset-2 ">
                                          <input class="btn btn-secondary form-control" type="file" name="image[]" multiple>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Thuộc loại sản phẩm<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <select class="form-control" name="id_type">
                                            @foreach ($type_product as $tp)
                                                <option @if ($product->id_type == $tp->id)
                                                  {{ 'selected' }}
                                                  @endif
                                                 value="{{$tp->id}}">{{ $tp->name }}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Thuộc hãng<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <select class="form-control" name="id_brand">
                                            @foreach ($brand as $b)
                                              <option @if ($product->id_brand == $b->id)
                                                {{ 'selected' }}
                                                @endif
                                               value="{{$b->id}}">{{ $b->name }}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Thuộc nhà cung cấp<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <select class="form-control" name="id_provider">
                                            @foreach ($provider as $pr)
                                              <option @if ($product->id_product == $pr->id)
                                                {{ 'selected' }}
                                                @endif
                                               value="{{$pr->id}}">{{ $pr->name }}</option>
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-lg-2">Mô tả<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <textarea class="form-control ckeditor" name="description" rows="6">{{$product->description}}</textarea>
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Giá gốc<span class="required">*</span></label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="regular_price" value="{{$product->regular_price}}" type="number" />
                                      </div>
                                  </div>
                                  <div class="form-group ">
                                      <label class="control-label col-lg-2">Giá sale</label>
                                      <div class="col-lg-10">
                                          <input class=" form-control" id="name" name="sale_price" value="{{$product->sale_price}}" type="number" />
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
